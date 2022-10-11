<?php
namespace App\Console\Commands;
use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use Illuminate\Console\Command;

class EventReset extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'event:reset {event}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Reset an event (cancelled, confirmed) and its bookings';

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
    // Update the event
    $event = Event::where('uuid', $this->argument('event'))->first();
    $event->cancelled = 0;
    $event->cancelled_at = NULL;
    $event->confirmed = 0;
    $event->confirmed_at = NULL;
    $event->save();

    // Update bookings
    $bookings = Booking::where('event_id', $event->id)->get();
    foreach($bookings as $booking)
    {
      $booking->cancelled = 0;
      $booking->cancelled_at = NULL;
      $booking->save();
    }
  }
}
