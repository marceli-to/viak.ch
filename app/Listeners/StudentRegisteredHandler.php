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
   * @param  StudentRegistered $studentRegisteredEvent
   * @return void
   */
  public function handle(StudentRegistered $studentRegisteredEvent)
  {
    Job::create([
      'recipient' => $studentRegisteredEvent->user->email,
      'mailable_id' => $studentRegisteredEvent->user->id,
      'mailable_type' => \App\Models\User::class,
      'mailable_class' => \App\Mail\StudentRegistered::class
    ]);
  }
}
