<?php
namespace App\Helpers;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class PenaltyHelper
{
  const RANGE_MIN = 16;
  const RANGE_MAX =  8;

  public static function get($eventData, $eventFee)
  { 
    // Penalties
    $penalties = [
      'full' => '100',
      'half'  => '50'
    ];

    $penalty = NULL;
    $amount = 0;

    // Diff between today and the event date
    $days = Carbon::parse($eventData)->diffInDays(Carbon::now());

    if ($days == 0 || $days < self::RANGE_MAX)
    {
      $penalty = $penalties['full'];
      $amount  = $eventFee / 100 * $penalties['full'];
    }
    else if ($days < self::RANGE_MIN)
    {
      $penalty = $penalties['half'];
      $amount  = $eventFee / 100 * $penalties['half'];
    }

    return [
      'penalty' => $penalty,
      'amount'  => $amount
    ];

  }

  public static function has($eventData)
  {
    // Diff between today and the event date
    $days = Carbon::parse($eventData)->diffInDays(Carbon::now());
    return $days < self::RANGE_MIN ? TRUE : FALSE;
  }
}