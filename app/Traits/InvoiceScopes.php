<?php
namespace App\Traits;

trait InvoiceScopes
{
  /**
   * Scope a query to only include paid invoices
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopePaid($query)
  {
    return $query->whereNotNull('paid_at');
  }

  /**
   * Scope a query to only include cancelled invoices
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeCancelled($query)
  {
    return $query->whereNotNull('cancelled_at');
  }

  /**
   * Scope a query to only include pending invoices
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopePending($query)
  {
    return $query->whereNull('paid_at')->whereNull('cancelled_at');
  }
}