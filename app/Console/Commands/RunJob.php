<?php
namespace App\Console\Commands;
use App\Models\Job;
use App\Models\Invoice;
use Illuminate\Console\Command;

class RunJob extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'run:job {--reset}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Run the job task';

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
    $reset = $this->option('reset');

    if ($reset)
    {
      $this->info('Clearing tables "invoices" and "jobs"');

      // Reset invoice
      Invoice::truncate();
      
      // Reset jobs
      Job::query()->update(['error' => null, 'processed' => 0]);
    }

    
    $jobs = Job::with('mailable')->unprocessed()->get();
    $jobs = collect($jobs)->splice(0,1);
    $env  = app()->environment();

    $this->info('Starting jobs...');


    foreach($jobs->all() as $j)
    {
      $recipient = ($env == 'staging' || $env == 'production') && $j->recipient ? $j->recipient : env('MAIL_TO');

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

    $this->info('The command was successful!');
  }
}
