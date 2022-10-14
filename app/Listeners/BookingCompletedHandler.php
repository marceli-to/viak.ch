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
   * @param  BookingCompleted $bookingCompletedEvent
   * @return void
   */
  public function handle(BookingCompleted $bookingCompletedEvent)
  {
    Job::create([
      'recipient' => $bookingCompletedEvent->user->email,
      'mailable_id' => $bookingCompletedEvent->booking->id,
      'mailable_type' => \App\Models\Booking::class,
      'mailable_class' => \App\Mail\BookingCompleted::class
    ]);

    // Confirm if event is already confirmed
    if ($bookingCompletedEvent->booking->event->confirmed)
    {
      Job::create([
        'recipient' => $bookingCompletedEvent->user->email,
        'mailable_id' => $bookingCompletedEvent->booking->id,
        'mailable_type' => \App\Models\Booking::class,
        'mailable_class' => \App\Mail\EventConfirmationStudent::class
      ]);
    }
  }
}
