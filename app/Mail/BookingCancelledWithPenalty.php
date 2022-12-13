<?php
namespace App\Mail;
use App\Models\Booking;
use App\Facades\Invoice;
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
    // Get the booking
    $booking = Booking::with('user', 'event')->find($this->data->id);

    // Get the penalty
    $cancellation = PenaltyHelper::get($booking->event->date, $booking->event->courseFee);

    // Find or create the invoice for this booking
    $invoice = Invoice::createFromBookingWithPenalty($booking, $cancellation);

    // Create the mail
    $mail = $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
                 ->subject(__('Annullationsbestätigung') . ' – ' . $booking->event->course->title)
                 ->with([
                   'data' => $booking,
                   'cancellation' => $cancellation
                 ])
                 ->markdown('mail.booking.cancellation-with-penalty');

    if ($invoice)
    {
      $mail->attach(
        public_path() . "/storage/files/{$booking->user->uuid}/{$invoice->filename}",
        ['mime' => 'application/pdf']
      );
    }

    return $mail;
  }
}