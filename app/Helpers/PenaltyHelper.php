<?php
namespace App\Helpers;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

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

  public static function has($eventDate)
  {
    // Diff between today and the event date
    // TRUE if the difference is within the minimum range (days_penalty_half)
    $days = Carbon::parse($eventDate)->diffInDays(Carbon::now());
    return $days < config('invoice.days_penalty_half') ? TRUE : FALSE;
  }
}