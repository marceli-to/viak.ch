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
    Job::create([
      'recipient' => $bookingCancelledWithPenaltyEvent->user->email,
      'mailable_id' => $bookingCancelledWithPenaltyEvent->booking->id,
      'mailable_type' => \App\Models\Booking::class,
      'mailable_class' => \App\Mail\BookingCancelledWithPenalty::class
    ]);
  }
}
