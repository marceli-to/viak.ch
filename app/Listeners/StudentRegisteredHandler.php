<?php
namespace App\Listeners;
use App\Events\StudentRegistered;
use App\Models\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StudentRegisteredHandler
{
  /**
   * Handle the event.
   *
   * @param  StudentRegistered $event
   * @return void
   */
  public function handle(StudentRegistered $event)
  {
    Job::create([
      'recipient' => $event->user->email,
      'mailable_id' => $event->user->id,
      'mailable_type' => \App\Models\User::class,
      'mailable_class' => \App\Mail\StudentRegistered::class
    ]);
  }
}
