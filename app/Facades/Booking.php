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
use App\Events\BookingCompleted;
use App\Events\BookingCancelled;
use App\Events\BookingCancelledWithPenalty;

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
      $user     = User::find(auth()->user()->id);
      $address  = isset($basket['invoice_address_uuid']) ? UserAddress::where('uuid', $basket['invoice_address_uuid'])->first() : NULL;
      $discount = isset($basket['discount_uuid']) ? DiscountCode::where('uuid', $basket['discount_uuid'])->first() : NULL;
      
      foreach($basket['items'] as $item)
      {
        // Get the event
        $event = Event::where('uuid', $item)->first();

        // Create the booking
        $booking = BookingModel::create([
          'uuid' => \Str::uuid(),
          'number' => self::getNumber(),
          'course_fee' => $event->courseFee,
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

        // Handle event participant limits
        EventParticipantLimit::handle($event);

        // Fire Event
        event(new BookingCompleted($user, $booking));
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
      event(new BookingCancelledWithPenalty(
        User::find($booking->user_id), 
        BookingModel::find($booking->id)
      ));
      return TRUE;
    }
    
    // No cancellation penalty
    event(new BookingCancelled(
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
    $bookings = BookingModel::withTrashed()->get();
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