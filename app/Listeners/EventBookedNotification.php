<?php
namespace App\Listeners;
use App\Events\EventBooked;
use App\Models\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EventBookedNotification
{
  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct()
  {
  }

  /**
   * Handle the event.
   *
   * @param  EventBooked $eventBooked
   * @return void
   */
  public function handle(EventBooked $eventBooked)
  {
    $job = Job::create([
      'recipient' => $eventBooked->user->email,
      'mailable_id' => $eventBooked->event->id,
      'mailable_type' => Event::class,
      'mailable_class' => \App\Mail\EventBooked::class
    ]);
  }
}
