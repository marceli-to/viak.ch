<?php
namespace App\Facades;
use Illuminate\Http\Request;
use App\Helpers\PenaltyHelper;
use App\Models\Booking as BookingModel;
use App\Facades\Bookmark as BookmarkFacade;
use App\Facades\Invoice as InvoiceFacade;
use App\Facades\RentalInvoice as RentalInvoiceFacade;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Event;
use App\Facades\Discount;
use App\Models\Invoice;
use App\Models\DiscountCode;
use App\Events\BookingCompleted;
use App\Events\BookingCancelled;
use App\Events\BookingCancelledWithPenalty;
use App\Events\RentalAdded;
use App\Events\RentalCancelled;
use App\Facades\ParticipantsChange;
use App\Facades\Message as MessageFacade;

class Booking
{
  /**
   * Turn a basket into bookings
   * 
   * @param Array $basket
   * @return Boolean
   */

  public static function create($basket = [])
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
        $event = Event::where('uuid', $item['uuid'])->first();

        if (BookingFacade::can($event, $user))
        {
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
            'has_rental' => isset($item['rental']) ? 1 : 0,
            'booked_at' => \Carbon\Carbon::now(),
          ]);
          
          // Update bookmarks
          BookmarkFacade::findAndDestroy($event, $user);

          // Update discount
          if ($discount)
          {
            Discount::update($discount);
          }

          // Fire event
          event(new BookingCompleted($user, $booking));

          // Handle event participant change
          ParticipantsChange::handle($booking->event);

          // Handle messages for this event
          MessageFacade::past($booking->event, $user);
        }
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

  public static function cancel(BookingModel $booking)
  {
    // Cancel booking
    $booking = BookingModel::find($booking->id);
    $booking->flag('isCancelled');
    $booking->cancelled_at = \Carbon\Carbon::now();
    $booking->save();

    // Handle event participant change
    ParticipantsChange::handle($booking->event, TRUE);

    // Check for cancellation penalty and fire events
    if (!$booking->event->free_of_charge && PenaltyHelper::has($booking->event->date) && PenaltyHelper::applies($booking->uuid))
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
   * Add a rental to a booking
   */

  public static function addRental(BookingModel $booking)
  {
    // Add rental to booking
    $booking = BookingModel::find($booking->id);
    $booking->has_rental = 1;
    $booking->save();

    event(new RentalAdded(
      User::find($booking->user_id), 
      BookingModel::find($booking->id)
    ));

    return TRUE;
  }

  /**
   * Cancel a rental in booking
   * 
   * @param BookingModel $booking
   * @return Boolean
   */

  public static function cancelRental(BookingModel $booking)
  {
    // Cancel booking
    $booking = BookingModel::find($booking->id);
    $booking->has_rental = 0;
    $booking->save();

    // Cancel the invoice
    $invoice = Invoice::where('booking_id', $booking->id)->where('is_rental', 1)->first();
    if ($invoice)
    {
      InvoiceFacade::delete($invoice);
    }

    event(new RentalCancelled(
      User::find($booking->user_id), 
      BookingModel::find($booking->id)
    ));

    return TRUE;
  }

  /**
   * Update participation for a booking
   * 
   * @param BookingModel $booking
   * @return Boolean
   */

  public static function updateParticipation(BookingModel $booking)
  {
    if (!$booking->hasFlag('hasParticipated'))
    {
      return $booking->flag('hasParticipated');
    }
    return $booking->unflag('hasParticipated');
  }

  /**
   * Check whether or not a student HAS a booking
   * for a specific event.
   * 
   * @param Event $event
   * @param User $user
   */

  public static function has(Event $event, User $user)
  {
    $booking = BookingModel::active()->where('event_id', $event->id)->where('user_id', $user->id)->first();
    return $booking === null ? FALSE : TRUE;
  }

  /**
   * Check whether or not a student CAN book an event
   * for a specific event.
   * 
   * @param Event $event
   * @param User $user
   */

   public static function can(Event $event, User $user)
   {
     $booking = BookingModel::active()->where('event_id', $event->id)->where('user_id', $user->id)->first();
     return $booking === null ? TRUE : FALSE;
   }
 
  /**
   * Get the next booking number
   * 
   * @return String number
   */

  public static function getNumber()
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

  public static function pad($number, $length = 6)
  {
    return str_pad($number, $length, "0", STR_PAD_LEFT);
  }

}