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

    // Diff between the now and the event
    $days = Carbon::parse($eventData)->diffInDays(Carbon::now());

    switch($days)
    {
      case $days < self::RANGE_MAX:
        $penalty = $penalties['full'];
      break;

      case $days < self::RANGE_MIN:
        $penalty = $penalties['half'];
      break;

      default:
        $penalty = NULL;
      break;
    }

    return [
      'penalty' => $penalty,
      'amount'  => $penalty ? $eventFee / 100 * $penalty : 0,
    ];
  }

  public static function has($eventData)
  {
    // Diff between the now and the event
    $days = Carbon::parse($eventData)->diffInDays(Carbon::now());
    return $days < self::RANGE_MIN ? TRUE : FALSE;
  }
}