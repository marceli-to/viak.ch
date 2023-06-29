<?php
namespace App\Tasks;

class ObserveEventState
{
  public function __invoke()
  {
    $constraint = \Carbon\Carbon::now()->addDays(10)->format('Y-m-d');
    $events = \App\Models\Event::where('date', $constraint)->notFlagged('isCancelled')->notFlagged('isConfirmed')->notFlagged('hasCancelOrConfirmReminder')->get();
    if ($events)
    {
      foreach($events as $event)
      {
        \App\Models\Job::create([
          'recipient' => env('MAIL_TO'),
          'mailable_id' => $event->id,
          'mailable_type' => \App\Models\Event::class,
          'mailable_class' => \App\Mail\EventCancelOrConfirmReminder::class
        ]);
        $event->flag('hasCancelOrConfirmReminder');
      }
    }
  }
}