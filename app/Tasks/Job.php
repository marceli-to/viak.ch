<?php
namespace App\Tasks;
use App\Models\Job as JobModel;

class Job
{
  public function __invoke()
  {
    $jobs = JobModel::with('mailable')->unprocessed()->get();
    $jobs = collect($jobs)->splice(0,2);
    $env  = app()->environment();

    $allowed_email = [
      'mail@0704.ch'
      // 'deiters@nightnurse.ch',
      // 'direk@nightnurse.ch',
      // 'oliver.schmid@visualisierungs-akademie.ch',
    ];

    foreach($jobs->all() as $job)
    {
      $recipient = ($env == 'preproduction' && in_array($job->recipient, $allowed_email)) ? $job->recipient : env('MAIL_TO');
      // $recipient = ($env == 'staging' || $env == 'production') && $job->recipient ? $job->recipient : env('MAIL_TO');
      try
      {
        \Mail::to($recipient)->send(new $job->mailable_class($job->mailable));
        $job->processed = 1;
        $job->save();
      }
      catch(\Throwable $e)
      {
        \Log::error($e);
        $job->error = $e;
        $job->processed = 1;
        $job->save();
      }
    }
  }
}