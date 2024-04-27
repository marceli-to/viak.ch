<?php
namespace App\Mail;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingCreatedInfoExpert extends Mailable
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
    // Get the Booking
    $booking = Booking::with('event.course', 'user')->find($this->data->id);

    // Get the user by email
    $email = collect($this->to)->pluck('address')->first();
    $user = User::where('email', $email)->first();

    return $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
                ->subject(__('Neue Anmeldung für ') . $booking->event->course->title)
                ->with(['booking' => $booking, 'user' => $user])
                ->markdown('mail.booking.created-info', ['recipient' => 'expert']);
  }
}