<?php
namespace App\Listeners;
use App\Events\ExpertCreated;
use App\Models\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ExpertCreatedHandler
{
  /**
   * Handle the event.
   *
   * @param  ExpertCreated $expertCreatedEvent
   * @return void
   */
  public function handle(ExpertCreated $expertCreatedEvent)
  {
    Job::create([
      'recipient' => $expertCreatedEvent->user->email,
      'mailable_id' => $expertCreatedEvent->user->id,
      'mailable_type' => \App\Models\User::class,
      'mailable_class' => \App\Mail\ExpertCreated::class
    ]);
  }
}
