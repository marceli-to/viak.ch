<?php
namespace App\Mail;
use App\Models\Booking;
use App\Services\Pdf\EventParticipationConfirmation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventClosedStudent extends Mailable
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
    
    // Create PDF
    $pdf = (new EventParticipationConfirmation())->create($booking);

    // Create the mail
    $mail = $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
                 ->subject(__('Teilnahmebestätigung') . ' – ' . $booking->event->course->title)
                 ->with(
                      [
                        'event' => $booking->event,
                        'booking' => $booking,
                        'user' => $booking->user,
                      ]
                    )
                 ->markdown('mail.event.attendance', ['recipient' => 'student']);
    
    // Attach the pdf
    if ($pdf)
    {
      $mail->attach($pdf['uri'], ['mime' => 'application/pdf']);
    }
    return $mail;
  }
}