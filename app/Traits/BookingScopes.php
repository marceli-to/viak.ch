<?php
namespace App\Traits;

trait BookingScopes
{
  /**
   * Scope a query to only include active bookings
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeActive($query)
  {
    return $query->notFlagged('isCancelled');
  }

  /**
   * Scope a query to only include cancelled bookings
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeCancelled($query)
  {
    return $query->flagged('isCancelled');
  }
}