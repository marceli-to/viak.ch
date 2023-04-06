<?php
namespace App\Mail;
use App\Models\Booking;
use App\Models\Event;
use App\Models\Invoice;
use App\Facades\Invoice as InvoiceFacade;
use App\Facades\Discount as DiscountFacade;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventCancelStudent extends Mailable
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
    // Get the booking
    $booking = Booking::with('event.course', 'user')->find($this->data->id);
    $invoice = Invoice::where('booking_id', $booking->id)->first();
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

    // Get the next 2 events after the just cancelled event
    $nextEvents = Event::upcoming()
      ->active()
      ->where('course_id', $booking->event->course->id)
      ->where('date', '>', $booking->event->date)
      ->orderBy('date', 'asc')
      ->take(2)
      ->get();

    // Create the mail
    return $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
                ->subject(__('Kursabsage') . ' – ' . $booking->event->course->title)
                ->with(
                    [
                      'event' => $booking->event,
                      'nextEvents' => $nextEvents ?? null,
                      'booking' => $booking,
                      'user' => $booking->user,
                      'discount' => $discount
                    ]
                  )
                ->markdown('mail.event.cancel', ['recipient' => 'student']);
  }
}