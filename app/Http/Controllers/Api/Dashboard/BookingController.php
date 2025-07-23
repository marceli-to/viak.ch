<?php
namespace App\Http\Controllers\Api\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use App\Facades\Booking as BookingFacade;
use App\Events\BookingCompleted;
use Illuminate\Http\Request;

class BookingController extends Controller
{
  /**
   * Create a booking for a student by admin
   * 
   * @param Request $request
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    $request->validate([
      'event_uuid' => 'required|string',
      'user_uuid' => 'required|string',
    ]);

    $event = Event::where('uuid', $request->input('event_uuid'))->firstOrFail();
    $user = User::where('uuid', $request->input('user_uuid'))->firstOrFail();
    
    // Check if there's an active booking (not cancelled and not deleted)
    $activeBooking = Booking::active()
                           ->where('event_id', $event->id)
                           ->where('user_id', $user->id)
                           ->first();
    
    if ($activeBooking) {
      return response()->json(['message' => 'Es existiert bereits eine Buchung'], 400);
    }

    // Check if there's a soft-deleted booking that we can restore
    $deletedBooking = Booking::onlyTrashed()
                            ->where('event_id', $event->id)
                            ->where('user_id', $user->id)
                            ->first();

    if ($deletedBooking) {
      // Restore the deleted booking
      $deletedBooking->restore();
      
      // Clear any cancellation flags and update dates
      $deletedBooking->unflag('isCancelled');
      $deletedBooking->cancelled_at = null;
      $deletedBooking->booked_at = \Carbon\Carbon::now();
      $deletedBooking->save();
      
      // Fire booking completed event
      event(new BookingCompleted($user, $deletedBooking));
      
      return response()->json(['message' => 'Buchung erstellt', 'booking' => $deletedBooking]);
    }

    // Check if there's a cancelled booking that we can reactivate
    $cancelledBooking = Booking::cancelled()
                              ->where('event_id', $event->id)
                              ->where('user_id', $user->id)
                              ->first();

    if ($cancelledBooking) {
      // Reactivate the cancelled booking
      $cancelledBooking->unflag('isCancelled');
      $cancelledBooking->cancelled_at = null;
      $cancelledBooking->booked_at = \Carbon\Carbon::now();
      $cancelledBooking->save();
      
      // Fire booking completed event
      event(new BookingCompleted($user, $cancelledBooking));
      
      return response()->json(['message' => 'Buchung erstellt', 'booking' => $cancelledBooking]);
    }

    // No existing booking found, create a new one
    $booking = Booking::create([
      'uuid' => \Str::uuid(),
      'number' => BookingFacade::getNumber(),
      'course_fee' => $event->courseFee,
      'invoice_address' => null,
      'discount_code' => null,
      'discount_amount' => null,
      'event_id' => $event->id,
      'user_id' => $user->id,
      'has_rental' => 0,
      'booked_at' => \Carbon\Carbon::now(),
    ]);

    // Fire booking completed event
    event(new BookingCompleted($user, $booking));
    
    return response()->json(['message' => 'Buchung erstellt', 'booking' => $booking]);
  }
}