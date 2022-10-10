<?php
namespace App\Console\Commands;
use App\Models\Job;
use Illuminate\Console\Command;

class RunLastJob extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'run:lastjob';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Re-run the last mail-job task';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
      parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    $job = Job::with('mailable')->processed()->latest()->first();
    $job->error = NULL;
    $job->save();

    $recipient = app()->environment(['production']) && $job->recipient ? $job->recipient : env('MAIL_TO');

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
