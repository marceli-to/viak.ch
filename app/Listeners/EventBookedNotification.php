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
   * @param  EventBooked $eventBooked
   * @return void
   */
  public function handle(EventBooked $eventBooked)
  {
    Job::create([
      'recipient' => $eventBooked->user->email,
      'mailable_id' => $eventBooked->event->id,
      'mailable_type' => \App\Models\Event::class,
      'mailable_class' => \App\Mail\EventBooked::class
    ]);
  }
}
