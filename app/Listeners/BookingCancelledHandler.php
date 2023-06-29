<?php
namespace App\Listeners;
use App\Events\BookingCancelled;
use App\Models\Invoice;
use App\Facades\Invoice as InvoiceFacade;
use App\Models\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BookingCancelledHandler
{
  /**
   * Handle the event.
   *
   * @param  BookingCancelled $bookingCancelledEvent
   * @return void
   */
  public function handle(BookingCancelled $bookingCancelledEvent)
  {
    // Send confirmation to user
    Job::create([
      'recipient' => $bookingCancelledEvent->user->email,
      'mailable_id' => $bookingCancelledEvent->booking->id,
      'mailable_type' => \App\Models\Booking::class,
      'mailable_class' => \App\Mail\BookingCancelled::class
    ]);

    // Send info to admin
    Job::create([
      'recipient' => env('MAIL_TO'),
      'mailable_id' => $bookingCancelledEvent->booking->event->id,
      'mailable_type' => \App\Models\Event::class,
      'mailable_class' => \App\Mail\BookingCancelledInfoAdmin::class
    ]);
  }
}
