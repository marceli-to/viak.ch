<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Base
{
  use SoftDeletes;

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */

  protected $casts = [
    'cancelled_at' => 'date:d.m.Y',
    'paid_at' => 'date:d.m.Y',
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   
	protected $fillable = [
    'number',
    'date',
    'total',
    'discount',
    'vat',
    'grand_total',
    'filename',
    'invoice_address',
    'cancel_reason',
    'paid',
    'cancelled',
    'uuid',
    'booking_id',
    'user_id',
    'paid_at',
    'cancelled_at',
  ];


  /*
  |--------------------------------------------------------------------------
  | Helpers
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   * Check for paid state
   * 
   * @return Boolean
   */

  public function isPaid()
  {
    return $this->paid == 1 ? TRUE : FALSE;
  }

  /**
   * Check for cancelled state
   * 
   * @return Boolean
   */

  public function isCancelled()
  {
    return $this->cancelled == 1 ? TRUE : FALSE;
  }


  /*
  |--------------------------------------------------------------------------
  | Relationships
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   * The booking for this invoice.
   */

  public function booking()
  {
    return $this->belongsTo(Booking::class);
  }

  /**
   * The user that belong to this course.
   */
  
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  /*
  |--------------------------------------------------------------------------
  | Local scopes
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   * Scope a query to only include paid invoices
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopePaid($query)
  {
    return $query->where('paid', 1);
  }

  /**
   * Scope a query to only include cancelled invoices
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeCancelled($query)
  {
    return $query->where('cancelled', 0);
  }


  /*
  |--------------------------------------------------------------------------
  | Mutators & Accessors
  |--------------------------------------------------------------------------
  |
  |
  */


  /**
   * Set the date.
   *
   * @param  string $value
   * @return void
   */

  public function setDateAttribute($value)
  {
    $this->attributes['date'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
  }

  /**
   * Get the date for an event_date.
   *
   * @param  string $value
   * @return string $date
   */

  public function getDateStrAttribute()
  {   
    return date('d. F Y', strtotime($this->date));
  }
}
