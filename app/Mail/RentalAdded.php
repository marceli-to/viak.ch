<?php
namespace App\Mail;
use App\Models\Booking;
use App\Facades\RentalInvoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RentalAdded extends Mailable
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
    
    // Check if the event is confirmed
    if ($booking->event->hasFlag('isConfirmed'))
    {
      // Find or create the rental invoice for this booking
      $rental_invoice = RentalInvoice::findOrCreateFromBooking($booking, TRUE);
    }
    else
    {
      $rental_invoice = NULL;
    }
  
    $mail = $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
                ->subject(__('Buchung Mietgerät für ') . $booking->event->course->title)
                ->with([
                    'event' => $booking->event,
                    'booking' => $booking,
                    'user' => $booking->user,
                    'rental_invoice' => $rental_invoice,
                  ])
                ->markdown('mail.booking.rental-added');

    if ($rental_invoice)
    {
      $mail->attach(
        storage_path() . "/app/public/files/{$booking->user->uuid}/{$rental_invoice->filename}",
        ['mime' => 'application/pdf']
      );
    }

    return $mail;
  }
}