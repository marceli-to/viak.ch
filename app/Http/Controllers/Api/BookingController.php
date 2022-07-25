<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use App\Events\EventBooked;
use App\Models\Booking;
use App\Stores\BasketStore;
use App\Services\Booking as BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
  protected $store;

  /**
   * Constructor
   */

  public function __construct()
  {
    $this->store = new BasketStore();
  }

  /**
   * Create a booking
   * 
   * @return \Illuminate\Http\Response
   */

  public function create()
  {
    $basket = $this->store->get();

    // Create bookings for all basket items
    foreach($basket['items'] as $item)
    {
      $event = Event::where('uuid', $item)->first();
      $user  = User::find(auth()->user()->id);
      $booking = Booking::create([
        'uuid' => \Str::uuid(),
        'number' => (new BookingService())->number(),
        'address' => $basket['user']['address'] ? $basket['user']['address'] : null,
        'event_id' => $event->id,
        'user_id' => $user->id,
        'booked_at' => \Carbon\Carbon::now(),
      ]);

      // Call event
      event(new EventBooked($user, $event));
    }

    // Clear the store
    $this->store->clear();

    return response()->json(true);
  }

}
