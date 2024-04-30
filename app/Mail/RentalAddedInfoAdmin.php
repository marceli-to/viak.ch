<?php
namespace App\Mail;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RentalAddedInfoAdmin extends Mailable
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

    return $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
                ->subject(__('Buchung Mietcomputer für ') . $booking->event->course->title)
                ->with(['booking' => $booking])
                ->markdown('mail.booking.rental-added-info');
  }
}