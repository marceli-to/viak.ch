<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EventUser extends Pivot
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  protected $fillable = [
    'event_id', 
    'user_id'
  ];

  /**
   * The event_dates that belong to this event.
   */
  
  public function user()
  {
    return $this->hasOne(User::class, 'id', 'user_id');
  }

}
