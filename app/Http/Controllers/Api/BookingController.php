<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use App\Stores\BasketStore;
use App\Facades\Booking as BookingFacade;
use App\Http\Requests\BookingParticipationRequest;
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
   * Store all basket items as booking.
   * 
   * @return \Illuminate\Http\Response
   */

  public function store()
  {
    if ($this->store->itemsCount())
    {
      BookingFacade::create($this->store->get());
      $this->store->clear();
    }
    return response()->json('successfully stored');
  }

  /**
   * Cancel a booking
   * 
   * @param Booking $booking
   * @return \Illuminate\Http\Response
   */

  public function cancel(Booking $booking)
  { 
    $this->authorize('cancel', $booking);
    BookingFacade::cancel($booking);
    return response()->json('successfully cancelled');
  }

  /**
   * Cancel a rental in booking
   * 
   * @param Booking $booking
   * @return \Illuminate\Http\Response
   */

   public function addRental(Booking $booking)
   { 
     BookingFacade::addRental($booking);
     return response()->json('successfully added');
   }

  /**
   * Cancel a rental in booking
   * 
   * @param Booking $booking
   * @return \Illuminate\Http\Response
   */

   public function cancelRental(Booking $booking)
   { 
     $this->authorize('cancel', $booking);
     BookingFacade::cancelRental($booking);
     return response()->json('successfully cancelled');
   }

  /**
   * Update participation for a booking
   * 
   * @param BookingParticipationRequest $request
   * @return \Illuminate\Http\Response
   */

  public function updateParticipation(BookingParticipationRequest $request)
  { 
    $event = Event::where('uuid', $request->input('event_uuid'))->first();
    $user = User::where('uuid', $request->input('user_uuid'))->first();
    $booking = Booking::where('event_id', $event->id)->where('user_id', $user->id)->first();
    BookingFacade::updateParticipation($booking);
    return response()->json('successfully updated');
  }

}
