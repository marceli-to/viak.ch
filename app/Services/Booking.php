<?php
namespace App\Services;
use Illuminate\Http\Request;
use App\Helpers\PenaltyHelper;
use App\Models\Booking as BookingModel;
use App\Services\Booking as BookingService;
use App\Services\Bookmark as BookmarkService;
use App\Models\User;
use App\Models\Event;
use App\Events\EventBooked;
use App\Events\EventCancelled;
use App\Events\EventCancelledWithPenalty;

class Booking
{

  /**
   * Turn basket into bookings
   * 
   * @param Array $basket
   * @return Boolean
   */

  public function create($basket = [])
  {
    // Create bookings for all basket items
    if ($basket['items'])
    {
      foreach($basket['items'] as $item)
      {
        $event = Event::where('uuid', $item)->first();
        $user  = User::find(auth()->user()->id);

        $booking = BookingModel::create([
          'uuid' => \Str::uuid(),
          'number' => (new BookingService())->getNumber(),
          'invoice_address' => $basket['user']['invoice_address'] ? $basket['user']['invoice_address'] : null,
          'event_id' => $event->id,
          'user_id' => $user->id,
          'booked_at' => \Carbon\Carbon::now(),
        ]);
        
        // Fire Event
        event(new EventBooked($user, $booking));
        
        // Clean up bookmarks
        (new BookmarkService())->findAndDestroy($event, $user);
      }
    }

    return TRUE;
  }

  /**
   * Cancel a booking
   * 
   * @param BookingModel $booking
   * @return Boolean
   */

  public function cancel(BookingModel $booking)
  {
    // Cancel booking
    $booking = BookingModel::find($booking->id);
    $booking->cancelled = 1;
    $booking->cancelled_at = \Carbon\Carbon::now();
    $booking->save();

    // Check for cancellation penalty and fire events
    if (PenaltyHelper::has($booking->event->date))
    {
      event(new EventCancelledWithPenalty(
        User::find($booking->user_id), 
        BookingModel::find($booking->id)
      ));
      return TRUE;
    }
    
    // No cancellation penalty
    event(new EventCancelled(
      User::find($booking->user_id), 
      BookingModel::find($booking->id)
    ));
    
    return TRUE;
  }

  /**
   * Check whether or not a student has a booking
   * for a specific event.
   * 
   * @param Event $event
   * @param User $user
   */

  public function has(Event $event, User $user)
  {
    $booking = BookingModel::where('event_id', $event->id)->where('user_id', $user->id)->whereNull('cancelled_at')->first();
    return $booking ? TRUE : FALSE;
  }

  /**
   * Get the next booking number
   * 
   * @return String number
   */

  public function getNumber()
  {
    $bookings = BookingModel::get();
    $number = 1;
    if ($bookings->count() >= 1)
    {
      $number = (int) $bookings->last()->number + 1;
    }
    return $this->pad($number);
  }

  /**
   * Pad an input
   * 
   * @param Integer $number
   * @return String padded input
   */

  private function pad($number, $length = 6)
  {
    return str_pad($number, $length, "0", STR_PAD_LEFT);
  }

}