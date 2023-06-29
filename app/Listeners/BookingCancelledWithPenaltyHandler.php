<?php
namespace App\Listeners;
use App\Events\BookingCancelledWithPenalty;
use App\Models\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BookingCancelledWithPenaltyHandler
{
  /**
   * Handle the event.
   *
   * @param  BookingCancelledWithPenalty $bookingCancelledWithPenaltyEvent
   * @return void
   */
  public function handle(BookingCancelledWithPenalty $bookingCancelledWithPenaltyEvent)
  {
    // Send confirmation to user
    Job::create([
      'recipient' => $bookingCancelledWithPenaltyEvent->user->email,
      'mailable_id' => $bookingCancelledWithPenaltyEvent->booking->id,
      'mailable_type' => \App\Models\Booking::class,
      'mailable_class' => \App\Mail\BookingCancelledWithPenalty::class
    ]);

    // Send info to admin
    Job::create([
      'recipient' => env('MAIL_TO'),
      'mailable_id' => $bookingCancelledWithPenaltyEvent->booking->event->id,
      'mailable_type' => \App\Models\Event::class,
      'mailable_class' => \App\Mail\BookingCancelledInfoAdmin::class
    ]);
  }
}
