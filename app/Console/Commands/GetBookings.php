<?php
namespace App\Console\Commands;
use App\Models\Event;
use Illuminate\Console\Command;

class GetBookings extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'get:bookings';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Get bookings for an event';

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
    $askEventUuid = $this->ask('Enter event uuid: ');
    $askType = $this->ask('Show count for active or cancelled bookings: [a/c]');
    $event = Event::with('bookings.user', 'cancelledBookings.user')->where('uuid', $askEventUuid)->first();
    
    if ($askType == 'a')
    {
      dd($event->bookings->count());
    }
    else
    {
      dd($event->cancelledBookings->count());
    }

  }
}
