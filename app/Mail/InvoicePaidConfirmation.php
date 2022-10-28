<?php
namespace App\Mail;
use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoicePaidConfirmation extends Mailable
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
    // Get the invoice
    $invoice = Invoice::with('booking.event.course', 'user')->find($this->data->id);

    return $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
                ->subject(__('Zahlungsbestätigung Rechnung Nr.') . ' – ' . $invoice->number)
                ->with(['invoice' => $invoice])
                ->markdown('mail.payment.notification', ['recipient' => 'student']);
  }
}