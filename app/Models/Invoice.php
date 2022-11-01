<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelFlags\Models\Concerns\HasFlags;

class Invoice extends Base
{
  use SoftDeletes, HasFlags;

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
    return $this->hasFlag('isPaid');
  }

  /**
   * Check for cancelled state
   * 
   * @return Boolean
   */

  public function isCancelled()
  {
    return $this->hasFlag('isCancelled');
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

  /**
   * The documents that belong to this invoice.
   */

  public function documents()
  {
    return $this->morphMany(UserDocument::class, 'fileable');
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
   * Get the date string for an invoice.
   *
   * @param  string $value
   * @return string $date
   */

  public function getDateStrAttribute()
  {   
    return date('d. F Y', strtotime($this->date));
  }


  /**
   * Get the paid_at date for an invoice.
   *
   * @param  string $value
   * @return string $date
   */

  public function getPaidAtStrAttribute()
  {   
    return date('d.m.Y', strtotime($this->paid_at));
  }
}
