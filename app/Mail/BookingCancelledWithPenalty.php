<?php
namespace App\Mail;
use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Helpers\PenaltyHelper;

class BookingCancelledWithPenalty extends Mailable
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
                ->subject(__('Annullationsbestätigung') . ' – ' . $booking->event->course->title)
                ->with([
                  'data' => $booking,
                  'cancellation' => PenaltyHelper::get($booking->event->date, $booking->event->courseFee)
                ])
                ->markdown('mail.booking.cancellation-with-penalty');
  }
}