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
    $eventUUid = $userId = $this->argument('event');

    $event = Event::where('uuid', $eventUUid)->first();

    $users = [
      '5f461f83-0295-499d-bc76-14467230bf41',
      '531e9038-77d5-4895-9ac2-41059f15029a',
      'db4c704d-a7c1-41ee-b662-b73fb7a8e818',
      'd3b99700-cf22-48aa-9cc6-20ab690e7a02'
    ];

    foreach($users as $user)
    {
      $user = User::where('uuid', $user)->first();

      $booking = Booking::create([
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
