<?php
namespace App\Listeners;
use App\Events\EventConfirmed;
use App\Models\Job;
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
    // Get event with all bookings


    // Create a job for the confirmation email to each student
    Job::create([
      'recipient' => env('MAIL_FROM_ADDRESS'),
      'mailable_id' => $event->event->id,
      'mailable_type' => \App\Models\Event::class,
      'mailable_class' => \App\Mail\EventConfirmed::class
    ]);

    // Create an invoice for each student

    // Create a job for the reminder email sent to the experts

  }
}
