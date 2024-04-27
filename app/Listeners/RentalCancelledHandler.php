<?php
namespace App\Listeners;
use App\Events\RentalCancelled;
use App\Models\Invoice;
use App\Facades\Invoice as InvoiceFacade;
use App\Models\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RentalCancelledHandler
{
  /**
   * Handle the event.
   *
   * @param  RentalCancelled $bookingRentalCancelledEvent
   * @return void
   */
  public function handle(RentalCancelled $bookingRentalCancelledEvent)
  {
    // Cancel the invoice
    
    // Send info to admin
    Job::create([
      'recipient' => env('MAIL_TO'),
      'mailable_id' => $bookingRentalCancelledEvent->booking->id,
      'mailable_type' => \App\Models\Booking::class,
      'mailable_class' => \App\Mail\RentalCancelledInfoAdmin::class
    ]);
  }
}
