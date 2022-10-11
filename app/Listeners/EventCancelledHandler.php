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
   * @param  EventCancelled $event
   * @return void
   */
  public function handle(EventCancelled $event)
  { 
    // Update event
    $event->event->cancelled = 1;
    $event->event->cancelled_at = \Carbon\Carbon::now();
    $event->event->save();

    // Get bookings for the event
    $bookings = $event->event->bookings()->get();

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
    $experts = $event->event->experts()->get();
    
    if ($experts)
    {
      foreach($experts as $expert)
      { 
        // Create a job for the confirmation email to each student
        Job::create([
          'recipient' => $expert->email,
          'mailable_id' => $event->event->id,
          'mailable_type' => \App\Models\Event::class,
          'mailable_class' => \App\Mail\EventCancelExpert::class
        ]);
      }
    }
  }
}
