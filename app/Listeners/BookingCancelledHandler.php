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
   * @param  BookingCancelled $bookingCancelledEvent
   * @return void
   */
  public function handle(BookingCancelled $bookingCancelledEvent)
  {
    Job::create([
      'recipient' => $bookingCancelledEvent->user->email,
      'mailable_id' => $bookingCancelledEvent->booking->id,
      'mailable_type' => \App\Models\Booking::class,
      'mailable_class' => \App\Mail\BookingCancelled::class
    ]);
  }
}
