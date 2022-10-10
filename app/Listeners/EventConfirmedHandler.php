<?php
namespace App\Listeners;
use App\Events\EventConfirmed;
use App\Models\Job;
use App\Models\Booking;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BookingCancelledHandler
{
  /**
   * Handle the event.
   *
   * @param  EventConfirmed $event
   * @return void
   */
  public function handle(EventConfirmed $event)
  { 
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
          'mailable_class' => \App\Mail\EventConfirmationStudent::class
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
          'mailable_class' => \App\Mail\EventConfirmationExpert::class
        ]);
      }
    }
  }
}
