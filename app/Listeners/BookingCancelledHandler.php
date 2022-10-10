<?php
namespace App\Listeners;
use App\Events\BookingCancelled;
use App\Models\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BookingCancelledHandler
{
  /**
   * Handle the event.
   *
   * @param  BookingCancelled $event
   * @return void
   */
  public function handle(BookingCancelled $event)
  {
    Job::create([
      'recipient' => $event->user->email,
      'mailable_id' => $event->booking->id,
      'mailable_type' => \App\Models\Booking::class,
      'mailable_class' => \App\Mail\BookingCancelled::class
    ]);
  }
}
