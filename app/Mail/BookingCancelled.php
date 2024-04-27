<?php
namespace App\Mail;
use App\Models\Booking;
use App\Models\Invoice;
use App\Facades\Invoice as InvoiceFacade;
use App\Facades\Discount as DiscountFacade;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingCancelled extends Mailable
{
  use Queueable, SerializesModels;

  protected $data;

  /**
   * Create a new message instance.
   *
   * @param $data
   * @return void
   */
  public function __construct($data)
  {
    $this->data = $data;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {    
    $booking = Booking::with('user', 'event')->find($this->data->id);
    $invoice = Invoice::where('booking_id', $booking->id)->where('is_rental', 0)->first();
    $discount = NULL;

    if ($invoice)
    {
      // Generate discount code for PAID invoices
      if ($invoice->isPaid())
      {
        $discount = DiscountFacade::store([
          'amount' => $invoice->grand_total,
          'fix' => 1,
          'percent' => 0,
          'valid_from' => \Carbon\Carbon::now()->format('Y-m-d'),
          'valid_to' => \Carbon\Carbon::now()->addYears(1)->format('Y-m-d'),
        ]);
      }

      // Delete any NOT YET PAID invoices
      if ($invoice->isPending())
      {
        InvoiceFacade::delete($invoice);
      }
    }

    if ($booking->has_rental)
    {
      $rental_invoice = Invoice::where('booking_id', $booking->id)->where('is_rental', 1)->first();
      // Delete any NOT YET PAID invoices
      if ($rental_invoice->isPending())
      {
        InvoiceFacade::delete($rental_invoice);
      }
    }

    return $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
                ->subject(__('Annullationsbestätigung') . ' – ' . $booking->event->course->title)
                ->with([
                    'data' => $booking,
                    'discount' => $discount
                  ])
                ->markdown('mail.booking.cancellation');
  }
}