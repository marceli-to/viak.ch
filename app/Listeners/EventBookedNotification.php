<?php
namespace App\Listeners;
use App\Events\EventBooked;
use App\Models\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EventBookedNotification
{
  /**
   * Handle the event.
   *
   * @param  EventBooked $event
   * @return void
   */
  public function handle(EventBooked $event)
  {
    Job::create([
      'recipient' => $event->user->email,
      'mailable_id' => $event->booking->id,
      'mailable_type' => \App\Models\Booking::class,
      'mailable_class' => \App\Mail\EventBooked::class
    ]);
  }
}
