<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventParticipantsResource;
use App\Http\Resources\EventMessageResource;
use App\Http\Resources\BookingResource;
use App\Http\Resources\FileResource;
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

  public function findExpertEvent(Event $event)
  {
    $this->authorize('containsEvent', $event);
    $event = Event::with('bookings.user', 'messages.user', 'files.messages')->find($event->id);

    $data = [
      'event' => new EventResource($event),
      'participants' => EventParticipantsResource::collection(
        $event->getStudents()
      ),
      'messages' => EventMessageResource::collection(
        $event->messages
      ),
      'files' => FileResource::collection(
        $event->files
      ),
    ];
    return response()->json($data);
  }

  /**
   * Find an event by a given booking
   * 
   * @param Event $event
   * @return \Illuminate\Http\Response
   */

  public function findStudentEvent(Event $event)
  {
    $booking = Booking::where('event_id', $event->id)->where('user_id', auth()->user()->id)->first();
    $this->authorize('viewEvent', $booking);
    $data = [
      'event' => new EventResource($event),
      'booking' => new BookingResource($booking),
      'messages' => EventMessageResource::collection(
        $event->messages
      ),
      'files' => FileResource::collection(
        $event->files
      ),
    ];
    return response()->json($data);
  }

}
