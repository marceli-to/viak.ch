<?php
namespace App\Traits;

trait InvoiceScopes
{
  /**
   * Scope a query to only include open invoices
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeOpen($query)
  {
    return $query->where('status', 'OPEN');
  }

  /**
   * Scope a query to only include pending invoices (open or overdue)
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopePending($query)
  {
    return $query->where('status', 'OPEN')->orWhere('status', 'OVERDUE');
  }

  /**
   * Scope a query to only include paid invoices
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopePaid($query)
  {
    return $query->where('status', 'PAID');
  }

  /**
   * Scope a query to only include cancelled invoices
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeCancelled($query)
  {
    return $query->where('status', 'CANCELLED');
  }

  /**
   * Scope a query to only include open invoices
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeOverdue($query)
  {
    return $query->where('status', 'OVERDUE');
  }

  /**
   * Scope a query to only include queued invoices
   * 
   * ---------------------------------------------------------------
   * The queued attribute is set nightly on open/overdue invoices to
   * allow batch processing / syncronising the invoices with the
   * external accounting system (Run My Accounts)
   * ---------------------------------------------------------------
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeQueued($query)
  {
    return $query->where('queued', 1);
  }
}