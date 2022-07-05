<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;

class Event extends Base
{
  
  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */

  protected $casts = [
    'registration_deadline' => 'date:d.m.Y',
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   
	protected $fillable = [
    'uuid',
    'registration_deadline',
    'min_participants',
    'max_participants',
    'online',
    'course_id',
    'location_id',
    'publish'
  ];

  /**
   * The course for this event.
   */

  public function course()
  {
    return $this->belongsTo(Course::class);
  }

  /**
   * The location for this event.
   */

  public function location()
  {
    return $this->belongsTo(Location::class);
  }

  /**
   * The event_dates that belong to this event.
   */
  
  public function dates()
  {
    return $this->hasMany(EventDate::class, 'event_id', 'id');
  }

  /**
   * The experts that belong to this event.
   */

  public function experts()
  {
    return $this->belongsToMany(User::class);
  }
}
