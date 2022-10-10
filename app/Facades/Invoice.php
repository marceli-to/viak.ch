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
   * Create an invoice from a bookng
   * 
   * @param Booking $booking
   * 
   */

  public function createFromBooking(Booking $booking)
  {
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

    $pdf = (new EventInvoice())->create($invoice);

    return $invoice;
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