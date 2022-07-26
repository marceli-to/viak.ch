<?php
namespace App\Listeners;
use App\Events\EventCancelledWithPenalty;
use App\Models\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EventCancelledWithPenaltyNotification
{
  /**
   * Handle the event.
   *
   * @param  EventCancelledWithPenalty $eventCancelledWithPenalty
   * @return void
   */
  public function handle(EventCancelledWithPenalty $eventCancelledWithPenalty)
  {
    Job::create([
      'recipient' => $eventCancelledWithPenalty->user->email,
      'mailable_id' => $eventCancelledWithPenalty->event->id,
      'mailable_type' => \App\Models\Event::class,
      'mailable_class' => \App\Mail\EventCancelledWithPenalty::class
    ]);
  }
}
