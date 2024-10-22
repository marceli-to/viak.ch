<?php
namespace App\Helpers;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\Booking;

class PenaltyHelper
{
  /**
   * Calculates the penalty
   * 
   * @param String $eventDate
   * @param Decimal $eventFee
   * @return Array [percentage, amount]
   */
  public static function get($eventDate, $eventFee)
  { 
    // Penalties in percent
    $penalties = [
      'full' => '100',
      'half'  => '50'
    ];

    $penalty = NULL;
    $amount = 0;

    // Diff between today and the event date
    $days = Carbon::parse($eventDate)->diffInDays(Carbon::now());

    if ($days == 0 || $days < config('invoice.days_penalty_full'))
    {
      $penalty = $penalties['full'];
      $amount  = $eventFee / 100 * $penalties['full'];
    }
    else if ($days < config('invoice.days_penalty_half'))
    {
      $penalty = $penalties['half'];
      $amount  = $eventFee / 100 * $penalties['half'];
    }

    return [
      'penalty' => $penalty, // in percent (%)
      'amount'  => $amount
    ];

  }

  /**
   * Check if the penalty applies in terms of days
   * 
   * @param String $eventDate
   * @return Boolean
   */
  public static function has($eventDate)
  {
    // Diff between today and the event date
    // TRUE if the difference is within the minimum range (days_penalty_half)
    $days = Carbon::parse($eventDate)->diffInDays(Carbon::now());
    return $days < config('invoice.days_penalty_half') ? TRUE : FALSE;
  }

  /**
   * Check if the penalty applies in terms of course fee and amount
   * 
   * @param String $uuid
   * @return Boolean
   */
  public static function applies($uuid)
  {
    $booking = Booking::where('uuid', $uuid)->firstOrFail();
    return $booking->course_fee > $booking->discount_amount ? TRUE : FALSE;
  }
}
