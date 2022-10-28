<?php
namespace App\Listeners;
use App\Events\InvoicePaid;
use App\Models\Invoice;
use App\Models\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class InvoicePaidHandler
{
  /**
   * Handle the event.
   *
   * @param  InvoicePaid $invoicePaidEvent
   * @return void
   */
  public function handle(InvoicePaid $invoicePaidEvent)
  {
    Job::create([
      'recipient' => $invoicePaidEvent->invoice->user->email,
      'mailable_id' => $invoicePaidEvent->invoice->id,
      'mailable_type' => \App\Models\Invoice::class,
      'mailable_class' => \App\Mail\InvoicePaidConfirmation::class
    ]);

    Job::create([
      'recipient' => env('MAIL_TO'),
      'mailable_id' => $invoicePaidEvent->invoice->id,
      'mailable_type' => \App\Models\Invoice::class,
      'mailable_class' => \App\Mail\InvoicePaidNotification::class
    ]);
  }
}
