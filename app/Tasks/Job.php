<?php
namespace App\Tasks;
use App\Models\Job as JobModel;

class Job
{
  public function __invoke()
  {
    $jobs = JobModel::with('mailable')->unprocessed()->get();
    $jobs = collect($jobs)->splice(0,1);

    foreach($jobs->all() as $j)
    {
      $recipient = app()->environment(['production']) && $j->recipient ? $j->recipient : env('MAIL_TO');
      try
      {
        \Mail::to($recipient)->send(new $j->mailable_class($j->mailable));
        $j->processed = 1;
        $j->save();
      }
      catch(\Throwable $e)
      {
        \Log::error($e);
        $j->error = $e;
        $j->processed = 1;
        $j->save();
      }
    }
  }
}