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
    'address',
    'billed',
    'cancelled',
    'event_id',
    'user_id',
    'booked_at',
    'cancelled_at',
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
  
  public function events()
  {
    return $this->hasOne(Event::class);
  }

  /**
   * The user that belong to this course.
   */
  
  public function user()
  {
    return $this->hasOne(Event::class);
  }

}
