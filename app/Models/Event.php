<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Base
{
  use SoftDeletes;

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */

  protected $casts = [
    'registration_until' => 'date:d.m.Y',
    'date' => 'date:d.m.Y',
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   
	protected $fillable = [
    'uuid',
    'date',
    'registration_until',
    'min_participants',
    'max_participants',
    'online',
    'fee',
    'course_id',
    'location_id',
    'publish'
  ];

  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */

  protected $appends = [
    'course_fee',
    'expert_ids'
  ];


  /*
  |--------------------------------------------------------------------------
  | Helpers
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   * Check for online
   * 
   * @return Boolean
   */

  public function isOnline()
  {
    return $this->online == 1 ? TRUE : FALSE;
  }


  /*
  |--------------------------------------------------------------------------
  | Relationships
  |--------------------------------------------------------------------------
  |
  |
  */

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


  /*
  |--------------------------------------------------------------------------
  | Local scopes
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   * Scope a query to only include online events
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeOnline($query)
  {
    return $query->where('online', 1);
  }

  /**
   * Scope a query to only include online events
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeOffline($query)
  {
    return $query->where('online', 0);
  }


  /*
  |--------------------------------------------------------------------------
  | Mutators & Accessors
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   * Get the date for an event_date.
   *
   * @param  string $value
   * @return string $date
   */

  public function getDateAttribute($value)
  {   
    return date('d. F Y', strtotime($value));
  }

  /**
   * Get the course fee attribute depending on whether the event 
   * has a 'fee'. If not, take the 'fee' of the parent course 
   *
   * @param  string $value
   * @return string $date
   */

  public function getCourseFeeAttribute($value)
  {   
    return $this->fee ? $this->fee : $this->course->fee;
  }

  /**
   * Get array of ids from the m:n relationships
   *
   */

  public function getExpertIdsAttribute()
  {
    return $this->experts->pluck('id');
  }

}
