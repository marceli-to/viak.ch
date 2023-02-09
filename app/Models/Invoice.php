<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelFlags\Models\Concerns\HasFlags;
use App\Models\Base;
use App\Traits\InvoiceScopes;

class Invoice extends Base
{
  use SoftDeletes, HasFlags, InvoiceScopes;

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */

  protected $casts = [
    'cancelled_at' => 'date:d.m.Y',
    'paid_at' => 'date:d.m.Y',
    'due_at' => 'date:d.m.Y',
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
    'status',
    'queued',
    'due_at',
    'paid_at',
    'cancelled_at',
  ];

  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */

  protected $appends = [
    'date_str',
    'date_short',
    'due_at_short',
    'paid_at_short',
  ];


  /*
  |--------------------------------------------------------------------------
  | Helpers
  |--------------------------------------------------------------------------
  |
  |
  */

/**
 * Check for open state
 * 
 * @return Boolean
 */

  public function isOpen()
  {
    return $this->status == 'OPEN' ? TRUE : FALSE;
  }
 
  /**
   * Check for paid state
   * 
   * @return Boolean
   */

  public function isPaid()
  {
    return $this->status == 'PAID' ? TRUE : FALSE;
  }

  /**
   * Check for cancelled state
   * 
   * @return Boolean
   */

  public function isCancelled()
  {
    return $this->status == 'CANCELLED' ? TRUE : FALSE;
  }

  /**
   * Check for overdue state
   * 
   * @return Boolean
   */

   public function isOverdue()
   {
    return $this->status == 'OVERDUE' ? TRUE : FALSE;
   }


  /**
   * Check for pending invoice
   * 
   * @return Boolean
   */

   public function isPending()
   {
    return $this->status != 'PAID' && $this->status != 'CANCELLED' ? TRUE : FALSE;
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
   * Get the short date for an invoice.
   *
   * @param  string $value
   * @return string $date
   */

  public function getDateShortAttribute()
  {   
    return date('d.m.Y', strtotime($this->date));
  }

  /**
   * Get the paid_at date for an invoice.
   *
   * @param  string $value
   * @return string $date
   */

  public function getPaidAtShortAttribute()
  {   
    return date('d.m.Y', strtotime($this->paid_at));
  }

  /**
   * Get the paid_at date for an invoice.
   *
   * @param  string $value
   * @return string $date
   */

   public function getDueAtShortAttribute()
   {   
     return date('d.m.Y', strtotime($this->due_at));
   }
}
