<?php
namespace App\Traits;

trait EventScopes
{

  /**
   * Scope a query to only include online events
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeOnline($query)
  {
    return $query->where('online', 1);
  }

  /**
   * Scope a query to only include online events
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeOffline($query)
  {
    return $query->where('online', 0);
  }

  /**
   * Scope a query to only include confirmed events
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeConfirmed($query)
  {
    return $query->where('confirmed', 1);
  }

  /**
   * Scope a query to only include not confirmed events
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeUnconfirmed($query)
  {
    return $query->where('confirmed', 0);
  }

  /**
   * Scope a query to only include cancelled events
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeCancelled($query)
  {
    return $query->flagged('isCancelled')->orderBy('date', 'DESC');
  }

  /**
   * Scope a query to only include active (= not cancelled) events
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeActive($query)
  {
    return $query->notFlagged('isCancelled');
  }

  /**
   * Scope a query to only include upcoming events
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeUpcoming($query)
  { 
    $constraint = date('Y-m-d', time());
    return $query->where('date', '>=', $constraint)->orderBy('date', 'ASC');
  }

  /**
   * Scope a query to only include upcoming events
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopePast($query)
  { 
    $constraint = date('Y-m-d', time());
    return $query->where('date', '<=', $constraint)->orderBy('date', 'DESC');
  }
}