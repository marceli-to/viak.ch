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
   * @param  BookingCancelledWithPenalty $event
   * @return void
   */
  public function handle(BookingCancelledWithPenalty $event)
  {
    Job::create([
      'recipient' => $event->user->email,
      'mailable_id' => $event->booking->id,
      'mailable_type' => \App\Models\Booking::class,
      'mailable_class' => \App\Mail\BookingCancelledWithPenalty::class
    ]);
  }
}
