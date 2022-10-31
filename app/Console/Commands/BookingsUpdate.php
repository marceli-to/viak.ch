<?php
namespace App\Console\Commands;
use App\Models\Booking;
use App\Facades\Booking as BookingFacade;
use App\Models\Event;
use App\Models\User;
use Illuminate\Console\Command;

class BookingsUpdate extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'bookings:update';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Add flag to all cancelled bookings';

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
    $bookings = Booking::where('cancelled', 1)->get();

    // Create bookings
    foreach($bookings as $booking)
    {
      $booking->flag('isCancelled');
    }
  }
}
