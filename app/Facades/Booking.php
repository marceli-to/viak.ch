<?php
namespace App\Facades;
use Illuminate\Http\Request;
use App\Helpers\PenaltyHelper;
use App\Models\Booking as BookingModel;
use App\Facades\Bookmark as BookmarkFacade;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Event;
use App\Facades\Discount;
use App\Models\DiscountCode;
use App\Events\EventBooked;
use App\Events\EventCancelled;
use App\Events\EventCancelledWithPenalty;

class Booking
{
  /**
   * Turn a basket into bookings
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
        $event    = Event::where('uuid', $item)->first();
        $user     = User::find(auth()->user()->id);
        $address  = isset($basket['user']['invoice_address']['uuid']) ? UserAddress::where('uuid', $basket['user']['invoice_address']['uuid'])->first() : NULL;
        $discount = isset($basket['discount']['uuid']) ? DiscountCode::where('uuid', $basket['discount']['uuid'])->first() : NULL;

        $booking = BookingModel::create([
          'uuid' => \Str::uuid(),
          'number' => self::getNumber(),
          'invoice_address' => $address ? $address->address : NULL,
          'discount_code' => $discount ? $discount->code : NULL,
          'discount_amount' => $discount ? Discount::apply($discount->uuid, $event->courseFee) : NULL,
          'event_id' => $event->id,
          'user_id' => $user->id,
          'booked_at' => \Carbon\Carbon::now(),
        ]);
        
        // Update bookmarks
        BookmarkFacade::findAndDestroy($event, $user);

        // Update discount
        if ($discount)
        {
          Discount::update($discount);
        }

        // Fire Event
        event(new EventBooked($user, $booking));
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
    return self::pad($number);
  }

  /**
   * Pad an input
   * 
   * @param Integer $number
   * @return String padded input
   */

  public function pad($number, $length = 6)
  {
    return str_pad($number, $length, "0", STR_PAD_LEFT);
  }

}