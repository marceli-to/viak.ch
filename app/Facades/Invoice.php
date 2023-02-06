<?php
namespace App\Facades;
use Illuminate\Http\Request;
use App\Models\Invoice as InvoiceModel;
use App\Actions\RMA\CreateInvoice as CreateInvoiceAction;
use App\Actions\RMA\CloseInvoice as CloseInvoiceAction;
use App\Actions\UserDocument\DeleteUserDocument as DeleteUserDocumentAction;
use App\Services\Pdf\Invoice\EventInvoice;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserDocument;
use App\Models\Event;
use App\Models\Booking;
use App\Facades\Discount;
use App\Models\DiscountCode;

class Invoice
{
  /**
   * Find an existing invoice for a booking.
   * 
   * @param Booking $booking
   * @return $invoice
   */

  public static function findFromBooking(Booking $booking)
  {
    return InvoiceModel::open()->where('booking_id', $booking->id)->first();
  }

  /**
   * Find or create an invoice from a booking.
   * 
   * @param Booking $booking
   * @return $invoice
   */

  public static function findOrCreateFromBooking(Booking $booking)
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

  public static function createFromBooking(Booking $booking)
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
      'user_id' => $booking->user->id,
      'due_at' => \Carbon\Carbon::now()->addDays(config('invoice.payment_period'))
    ]);

    // Write invoice as PDF
    $pdf = (new EventInvoice())->create($invoice);

    // Action create invoice in Run My Accounts
    if (app()->environment() == 'production')
    {
      (new CreateInvoiceAction())->execute($invoice);
    }

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

  public static function createFromBookingWithPenalty(Booking $booking, $cancellation)
  {
    // Check for an existing invoice for a booking
    $oldInvoice = self::findFromBooking($booking);
    
    // Create new invoice
    $newInvoice = InvoiceModel::create([
      'uuid' => \Str::uuid(),
      'number' => self::getNumber(),
      'date' => \Carbon\Carbon::now(),
      'total' => $cancellation['amount'],
      'discount' => NULL,
      'vat' => 0.00,
      'grand_total' => self::getGrandTotal($cancellation['amount']),
      'invoice_address' => $booking->invoice_address ? $booking->invoice_address : NULL,
      'booking_id' => $booking->id,
      'user_id' => $booking->user->id,
      'due_at' => \Carbon\Carbon::now()->addDays(config('invoice.payment_period'))
    ]);

    // Write new invoice as PDF
    $pdf = (new EventInvoice())->create($newInvoice);

    // Update new invoice
    $newInvoice->filename = $pdf['filename'];
    $newInvoice->save();

    // Create an new invoice in "Run My Accounts"
    if (app()->environment() == 'production')
    {
      (new CreateInvoiceAction())->execute($newInvoice);
    }

    // Cancel an old invoice
    if ($oldInvoice)
    {
      self::cancel($oldInvoice, $newInvoice);
    }

    return $newInvoice;
  }

  /**
   * Cancel an existing invoice
   * 
   * @param Invoice $oldInvoice
   * @param Invoice $newInvoice
   * @return Boolean
   */

  public static function cancel(Invoice $oldInvoice, Invoice $newInvoice)
  {
    $oldInvoice->status = 'CANCELLED';
    $oldInvoice->cancelled_at = \Carbon\Carbon::now();
    $oldInvoice->cancel_reason = 'Replaced by Invoice No. ' . $newInvoice->number;
    $oldInvoice->save();

    // Creates a cancellaction invoice in "Run My Accounts"
    // with the same invoice data but a negative amount and
    // the cancellation suffix
    if (app()->environment() == 'production')
    {
      (new CreateInvoiceAction())->execute($oldInvoice, TRUE);

      // Closes the above created cancellation invoice in "Run My Accounts"
      // with the same invoice data but a negative amount and
      // the cancellation suffix
      (new CloseInvoiceAction())->execute($oldInvoice, TRUE);
  
      // Closes the existing invoice in "Run My Accounts"
      (new CloseInvoiceAction())->execute($oldInvoice);
  
      // Deletes the document from "user_documents" table
      (new DeleteUserDocumentAction())->execute($oldInvoice->id);
    }
  }

  /**
   * Get the grand total
   * 
   * @param Decimal $fee
   * @param Decimal $discount
   * @return Decimal $grand_total
   */

  public static function getGrandTotal($fee, $discount = NULL)
  {
    return $discount ? $fee - $discount : $fee;
  }
  
  /**
   * Get the next invoice number
   * 
   * @return String number
   */

  public static function getNumber()
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

  public static function pad($number, $length = 6)
  {
    return str_pad($number, $length, "0", STR_PAD_LEFT);
  }

}