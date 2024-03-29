<?php
namespace App\Console\Commands;
use App\Models\Booking;
use App\Facades\Booking as BookingFacade;
use App\Models\Event;
use App\Models\User;
use Illuminate\Console\Command;

class BookingsCreate extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'booking:create';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Create sample bookings for an event';

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
    // Ask for event uuid as input
    $eventUuid = $this->ask('Please enter the event uuid:');

    // Get the event
    $event = Event::where('uuid', $eventUuid)->first();

    // Get users
    $users = User::where('email', 'like', 'viak-student%@0704.ch')->get();

    // Create bookings
    foreach($users as $user)
    {
      if (BookingFacade::can($event, $user))
      {
        Booking::create([
          'uuid' => \Str::uuid(),
          'number' => BookingFacade::getNumber(),
          'course_fee' => $event->courseFee,
          'invoice_address' => NULL,
          'discount_code' => NULL,
          'discount_amount' => NULL,
          'event_id' => $event->id,
          'user_id' => $user->id,
          'booked_at' => \Carbon\Carbon::now(),
        ]);
      }
    }
  }
}
