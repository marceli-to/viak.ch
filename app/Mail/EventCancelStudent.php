<?php
namespace App\Mail;
use App\Models\Booking;
use App\Facades\Invoice;
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

    // Update the booking
    $booking->flag('isCancelled');
    $booking->cancelled_at = \Carbon\Carbon::now();
    $booking->save();

    // Create the mail
    return $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
                ->subject(__('Kursabsage') . ' – ' . $booking->event->course->title)
                ->with(
                    [
                      'event' => $booking->event,
                      'booking' => $booking,
                      'user' => $booking->user
                    ]
                  )
                ->markdown('mail.event.cancel', ['recipient' => 'student']);
  }
}