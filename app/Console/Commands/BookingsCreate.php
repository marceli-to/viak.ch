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
  protected $signature = 'booking:create {event}';

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
    // Get the event
    $event = Event::where('uuid', $this->argument('event'))->first();

    // Get users
    $users = User::where('email', 'like', 'viak-student%@0704.ch')->get();

    // // Create bookings
    // foreach($users as $user)
    // {
    //   if (BookingFacade::has($event, $user))
    //   {
    //     return;
    //   }
      
    //   $booking = Booking::create([
    //     'uuid' => \Str::uuid(),
    //     'number' => BookingFacade::getNumber(),
    //     'course_fee' => $event->courseFee,
    //     'invoice_address' => NULL,
    //     'discount_code' => NULL,
    //     'discount_amount' => NULL,
    //     'event_id' => $event->id,
    //     'user_id' => $user->id,
    //     'booked_at' => \Carbon\Carbon::now(),
    //   ]);
    // }

    // viak.ch.marceli.to - booking for user Oliver Schmid
    $booking = Booking::create([
      'uuid' => \Str::uuid(),
      'number' => BookingFacade::getNumber(),
      'course_fee' => $event->courseFee,
      'invoice_address' => NULL,
      'discount_code' => NULL,
      'discount_amount' => NULL,
      'event_id' => $event->id,
      'user_id' => '47',
      'booked_at' => \Carbon\Carbon::now(),
    ]);
  }
}
