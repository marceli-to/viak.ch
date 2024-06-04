<?php
namespace App\Mail;
use App\Models\Booking;
use App\Facades\Invoice;
use App\Facades\RentalInvoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventConfirmationStudent extends Mailable
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
    
    // Find or create the invoice for this booking
    $invoice = NULL;
    if (!$booking->event->free_of_charge)
    {
      $invoice = Invoice::findOrCreateFromBooking($booking);
    }

    // Find or create the rental invoice for this booking if it has rental
    $rental_invoice = $booking->has_rental ? RentalInvoice::findOrCreateFromBooking($booking) : NULL;

    // Create the mail
    $mail = $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
                 ->subject(__('Kursbestätigung') . ' – ' . $booking->event->course->title)
                 ->with(
                      [
                        'event' => $booking->event,
                        'booking' => $booking,
                        'user' => $booking->user,
                        'invoice' => $invoice,
                        'rental_invoice' => $rental_invoice,
                      ]
                    )
                 ->markdown('mail.event.confirmation', ['recipient' => 'student']);
                      
    if ($invoice)
    {
      $mail->attach(
        storage_path() . "/app/public/files/{$booking->user->uuid}/{$invoice->filename}",
        ['mime' => 'application/pdf']
      );
    }

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