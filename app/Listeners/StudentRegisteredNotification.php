<?php
namespace App\Listeners;
use App\Events\StudentRegistered;
use App\Models\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StudentRegisteredNotification
{
  /**
   * Handle the event.
   *
   * @param  StudentRegistered $studentRegistered
   * @return void
   */
  public function handle(StudentRegistered $studentRegistered)
  {
    Job::create([
      'recipient' => $studentRegistered->user->email,
      'mailable_id' => $studentRegistered->user->id,
      'mailable_type' => \App\Models\User::class,
      'mailable_class' => \App\Mail\StudentRegistered::class
    ]);
  }
}
