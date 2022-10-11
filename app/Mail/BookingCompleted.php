<?php
namespace App\Mail;
use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingCompleted extends Mailable
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
    return $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
                ->subject(__('Buchungsbestätigung') . ' – ' . $booking->event->course->title)
                ->with([
                    'event' => $booking->event,
                    'booking' => $booking,
                    'user' => $booking->user
                  ])
                ->markdown('mail.booking.confirmation');
  }
}