<?php
namespace App\Listeners;
use App\Events\EventClosed;
use App\Models\Job;
use App\Models\Booking;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EventClosedHandler
{
  /**
   * Handle the event.
   *
   * @param  EventClosed $eventClosedEvent
   * @return void
   */
  public function handle(EventClosed $eventClosedEvent)
  { 
    // Get bookings for the event
    $bookings = $eventClosedEvent->event->bookings()->get();

    if ($bookings)
    {
      foreach($bookings as $booking)
      { 
        // Create a job for the confirmation email to each student
        if ($booking->hasFlag('hasParticipated'))
        {
          Job::create([
            'recipient' => $booking->user->email,
            'mailable_id' => $booking->id,
            'mailable_type' => \App\Models\Booking::class,
            'mailable_class' => \App\Mail\EventClosedStudent::class
          ]);
          $booking->flag('isConcluded');
          $booking->flag('wasSentAttendanceConfirmation');
        }
      }
    }

    // // Get the experts
    // $experts = $eventConfirmedEvent->event->experts()->get();
    
    // if ($experts)
    // {
    //   foreach($experts as $expert)
    //   { 
    //     // Create a job for the confirmation email to each expert
    //     Job::create([
    //       'recipient' => $expert->email,
    //       'mailable_id' => $eventConfirmedEvent->event->id,
    //       'mailable_type' => \App\Models\Event::class,
    //       'mailable_class' => \App\Mail\EventConfirmationExpert::class
    //     ]);
    //   }
    // }
  }
}
