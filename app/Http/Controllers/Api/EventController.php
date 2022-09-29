<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExpertEventResource;
use App\Http\Resources\EventParticipantsResource;
use App\Http\Resources\BookingResource;
use App\Models\User;
use App\Models\Event;
use App\Models\Booking;
use Illuminate\Http\Request;

class EventController extends Controller
{

  /**
   * Find an event by a given booking
   * 
   * @param Event $event
   * @return \Illuminate\Http\Response
   */

  public function find(Event $event)
  {
    $this->authorize('containsEvent', $event);
    $event = Event::with('bookings.user')->find($event->id);
    $data = [
      'event' => new ExpertEventResource($event),
      'participants' => EventParticipantsResource::collection(
        $event->bookings->pluck('user')->all()
      )
    ];
    return response()->json($data);
  }

  /**
   * Find an event by a given booking
   * 
   * @param Booking $booking
   * @return \Illuminate\Http\Response
   */

  public function findByBooking(Booking $booking)
  {
    $this->authorize('viewEvent', $booking);
    return response()->json(new BookingResource($booking));
  }

}
