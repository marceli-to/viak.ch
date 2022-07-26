<?php
namespace App\Listeners;
use App\Events\EventCancelled;
use App\Models\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EventCancelledNotification
{
  /**
   * Handle the event.
   *
   * @param  EventCancelled $eventCancelled
   * @return void
   */
  public function handle(EventCancelled $eventCancelled)
  {
    Job::create([
      'recipient' => $eventCancelled->user->email,
      'mailable_id' => $eventCancelled->event->id,
      'mailable_type' => \App\Models\Event::class,
      'mailable_class' => \App\Mail\EventCancelled::class
    ]);
  }
}
