<?php
namespace App\Listeners;
use App\Events\EventCancelled;
use App\Models\Job;
use App\Models\Booking;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EventCancelledHandler
{
  /**
   * Handle the event.
   *
   * @param  EventCancelled $eventCancelledEvent
   * @return void
   */
  public function handle(EventCancelled $eventCancelledEvent)
  { 
    // Get bookings for the event
    $bookings = $eventCancelledEvent->event->bookings()->get();

    if ($bookings)
    {
      foreach($bookings as $booking)
      { 
        // Create a job for the confirmation email to each student
        Job::create([
          'recipient' => $booking->user->email,
          'mailable_id' => $booking->id,
          'mailable_type' => \App\Models\Booking::class,
          'mailable_class' => \App\Mail\EventCancelStudent::class
        ]);
      }
    }

    // Get the experts
    $experts = $eventCancelledEvent->event->experts()->get();
    
    if ($experts)
    {
      foreach($experts as $expert)
      { 
        // Create a job for the confirmation email to each student
        Job::create([
          'recipient' => $expert->email,
          'mailable_id' => $eventCancelledEvent->event->id,
          'mailable_type' => \App\Models\Event::class,
          'mailable_class' => \App\Mail\EventCancelExpert::class
        ]);
      }
    }
  }
}
