<?php
namespace App\Facades;
use Illuminate\Http\Request;
use App\Models\Invoice as InvoiceModel;
use App\Services\Pdf\Invoice\EventInvoice;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Event;
use App\Models\Booking;
use App\Facades\Discount;
use App\Models\DiscountCode;

class Invoice
{
  
  /**
   * Check for an existing invoice for a booking.
   * 
   * @param Booking $booking
   * @return $invoice
   */

  public function findFromBooking(Booking $booking)
  {
    return InvoiceModel::pending()->where('booking_id', $booking->id)->first();
  }

  /**
   * Find or create an invoice from a booking.
   * 
   * @param Booking $booking
   * @return $invoice
   */

  public function findOrCreateFromBooking(Booking $booking)
  {
    // Check for an existing invoice for a booking
    $invoice = self::findFromBooking($booking);
    if ($invoice)
    {
      return $invoice;
    }

    return self::createFromBooking($booking);
  }

  /**
   * Create an invoice from a booking.
   * 
   * @param Booking $booking
   * @return $invoice
   */

  public function createFromBooking(Booking $booking)
  {
    // Create invoice
    $invoice = InvoiceModel::create([
      'uuid' => \Str::uuid(),
      'number' => self::getNumber(),
      'date' => \Carbon\Carbon::now(),
      'total' => $booking->course_fee,
      'discount' => $booking->discount_amount,
      'vat' => 0.00,
      'grand_total' => self::getGrandTotal($booking->course_fee, $booking->discount_amount),
      'invoice_address' => $booking->invoice_address ? $booking->invoice_address : NULL,
      'booking_id' => $booking->id,
      'user_id' => $booking->user->id
    ]);

    // Write invoice as PDF
    $pdf = (new EventInvoice())->create($invoice);

    // Update invoice
    $invoice->filename = $pdf['filename'];
    $invoice->save();

    return $invoice;
  }

  /**
   * Create an invoice from a booking with a penalty for late cancellation.
   * 
   * @param Booking $booking
   * @param Array $cancellation
   * @return $invoice
   */

  public function createFromBookingWithPenalty(Booking $booking, $cancellation)
  {
    // Check for an existing invoice for a booking
    $existingInvoice = self::findFromBooking($booking);
    
    // Create invoice
    $invoiceWithPenalty = InvoiceModel::create([
      'uuid' => \Str::uuid(),
      'number' => self::getNumber(),
      'date' => \Carbon\Carbon::now(),
      'total' => $cancellation['amount'],
      'discount' => NULL,
      'vat' => 0.00,
      'grand_total' => self::getGrandTotal($cancellation['amount']),
      'invoice_address' => $booking->invoice_address ? $booking->invoice_address : NULL,
      'booking_id' => $booking->id,
      'user_id' => $booking->user->id
    ]);

    // Write invoice as PDF
    $pdf = (new EventInvoice())->create($invoiceWithPenalty);

    // Update invoice
    $invoiceWithPenalty->filename = $pdf['filename'];
    $invoiceWithPenalty->save();

    // Cancel an existing invoice
    if ($existingInvoice)
    {
      $existingInvoice->cancelled = 1;
      $existingInvoice->cancelled_at = \Carbon\Carbon::now();
      $existingInvoice->cancel_reason = 'Replaced by Invoice No. ' . $invoiceWithPenalty->number;
      $existingInvoice->save();
    }

    return $invoiceWithPenalty;
  }

  /**
   * Get the grand total
   * 
   * @param Decimal $fee
   * @param Decimal $discount
   * @return Decimal $grand_total
   */

  public function getGrandTotal($fee, $discount = NULL)
  {
    return $discount ? $fee - $discount : $fee;
  }
  
  /**
   * Get the next invoice number
   * 
   * @return String number
   */

  public function getNumber()
  {
    $invoices = InvoiceModel::withTrashed()->get();
    $number = 1;
    if ($invoices->count() >= 1)
    {
      $number = (int) $invoices->last()->number + 1;
    }
    return self::pad($number);
  }

  /**
   * Pad an input
   * 
   * @param Integer $number
   * @param Integer $length
   * @return String padded input
   */

  public function pad($number, $length = 6)
  {
    return str_pad($number, $length, "0", STR_PAD_LEFT);
  }

}