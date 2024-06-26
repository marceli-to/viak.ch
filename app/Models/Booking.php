<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelFlags\Models\Concerns\HasFlags;
use App\Models\Base;
use App\Traits\BookingScopes;

class Booking extends Base
{
  use SoftDeletes, HasFlags, BookingScopes;

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */

  protected $casts = [
    'cancelled_at' => 'date:d.m.Y',
    'booked_at' => 'date:d.m.Y',
  ];
  
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   
	protected $fillable = [
    'uuid',
    'number',
    'course_fee',
    'invoice_address',
    'discount_code',
    'discount_amount',
    'event_id',
    'user_id',
    'has_rental',
    'booked_at',
    'cancelled_at',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */

  protected $hidden = [
    'cancelled_at', 
  ];


  /**
   * The relationships that should always be loaded
   *
   * @var array
   */

  protected $with = [
    'event.course', 
    'event.location', 
    'event.experts', 
    'event.dates'
  ];


  /*
  |--------------------------------------------------------------------------
  | Relationships
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   * The event that belong to this course.
   */
  
  public function event()
  {
    return $this->hasOne(Event::class, 'id', 'event_id');
  }

  /**
   * The user that belong to this course.
   */
  
  public function user()
  {
    return $this->hasOne(User::class, 'id', 'user_id');
  }

  /**
   * The documents that belong to this booking.
   */

  public function documents()
  {
    return $this->morphMany(UserDocument::class, 'fileable');
  }
}
