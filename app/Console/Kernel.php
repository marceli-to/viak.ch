<?php
namespace App\Console;
use App\Tasks\Job;
use App\Tasks\CleanUpTempFolder;
use App\Tasks\ObserveEventState;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
  /**
   * The Artisan commands provided by your application.
   *
   * @var array
   */
  protected $commands = [];

  /**
   * Define the application's command schedule.
   *
   * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
   * @return void
   */
  protected function schedule(Schedule $schedule)
  {
    $schedule->call(new Job)->everyMinute();
    $schedule->call(new CleanUpTempFolder)->everyMinute();
    $schedule->call(new ObserveEventState)->everyMinute();
  }

  /**
   * Register the commands for the application.
   *
   * @return void
   */
  protected function commands()
  {
    $this->load(__DIR__.'/Commands');
    require base_path('routes/console.php');
  }
}