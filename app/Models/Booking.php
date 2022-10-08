<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Booking extends Base
{
  use SoftDeletes;

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
    'invoice_address',
    'discount_code',
    'discount_amount',
    'billed',
    'cancelled',
    'event_id',
    'user_id',
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

}
