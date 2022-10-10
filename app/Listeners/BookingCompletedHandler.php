<?php
namespace App\Listeners;
use App\Events\BookingCompleted;
use App\Models\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BookingCompletedHandler
{
  /**
   * Handle the event.
   *
   * @param  BookingCompleted $event
   * @return void
   */
  public function handle(BookingCompleted $event)
  {
    Job::create([
      'recipient' => $event->user->email,
      'mailable_id' => $event->booking->id,
      'mailable_type' => \App\Models\Booking::class,
      'mailable_class' => \App\Mail\BookingCompleted::class
    ]);
  }
}
