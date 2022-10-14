<?php
namespace App\Listeners;
use App\Events\EventConfirmed;
use App\Models\Job;
use App\Models\Booking;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EventConfirmedHandler
{
  /**
   * Handle the event.
   *
   * @param  EventConfirmed $eventConfirmedEvent
   * @return void
   */
  public function handle(EventConfirmed $eventConfirmedEvent)
  { 
    // Get bookings for the event
    $bookings = $eventConfirmedEvent->event->bookings()->get();

    if ($bookings)
    {
      foreach($bookings as $booking)
      { 
        // Create a job for the confirmation email to each student
        Job::create([
          'recipient' => $booking->user->email,
          'mailable_id' => $booking->id,
          'mailable_type' => \App\Models\Booking::class,
          'mailable_class' => \App\Mail\EventConfirmationStudent::class
        ]);
      }
    }

    // Get the experts
    $experts = $eventConfirmedEvent->event->experts()->get();
    
    if ($experts)
    {
      foreach($experts as $expert)
      { 
        // Create a job for the confirmation email to each student
        Job::create([
          'recipient' => $expert->email,
          'mailable_id' => $eventConfirmedEvent->event->id,
          'mailable_type' => \App\Models\Event::class,
          'mailable_class' => \App\Mail\EventConfirmationExpert::class
        ]);
      }
    }
  }
}
