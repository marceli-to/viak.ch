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
    'registration_until'  => 'date:d.m.Y',
    'date'                => 'date:d.m.Y',
    'confirmed_at'        => 'date:d.m.Y',
    'cancelled_at'        => 'date:d.m.Y',
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
    'publish',
    'confirmed',
    'cancelled'
  ];

  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */

  protected $appends = [
    'number',
    'date_str',
    'date_short',
    'course_fee',
    'course_online',
    'expert_ids',
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

  /**
   * Check for confirmed
   * 
   * @return Boolean
   */

  public function isConfirmed()
  {
    return $this->confirmed == 1 ? TRUE : FALSE;
  }

  /**
   * Check for cancelled
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
    return $this->hasMany(EventDate::class, 'event_id', 'id')->orderBy('date');
  }

  /**
   * The experts that belong to this event.
   */

  public function experts()
  {
    return $this->belongsToMany(User::class);
  }

  /**
   * The bookings that belong to this event.
   */
  
  public function allBookings()
  {
    return $this->hasMany(Booking::class, 'event_id', 'id');
  }

  /**
   * The (active) bookings that belong to this event.
   */
  
  public function bookings()
  {
    return $this->hasMany(Booking::class, 'event_id', 'id')->where('cancelled', 0);
  }


  /**
   * The messages that belongs to this event.
   */

  public function messages()
  {
    return $this->morphMany(Message::class, 'messageable')->orderBy('created_at', 'DESC');
  }

  /**
   * The files that belongs to this event.
   */

  public function files()
  {
    return $this->morphToMany(File::class, 'fileable')->orderBy('created_at', 'DESC');
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

  /**
   * Scope a query to only include confirmed events
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeConfirmed($query)
  {
    return $query->where('confirmed', 1);
  }

  /**
   * Scope a query to only include not confirmed events
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeUnconfirmed($query)
  {
    return $query->where('confirmed', 0);
  }

  /**
   * Scope a query to only include cancelled events
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeCancelled($query)
  {
    return $query->where('cancelled', 1);
  }

  /**
   * Scope a query to only include active (= not cancelled) events
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeActive($query)
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
   * Set the registration_until date.
   *
   * @param  string $value
   * @return void
   */

  public function setRegistrationUntilAttribute($value)
  {
    $this->attributes['registration_until'] = $value ? \Carbon\Carbon::parse($value)->format('Y-m-d') : NULL;
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

  /**
   * Get the short version for an event_date.
   *
   * @param  string $value
   * @return string $date
   */

  public function getDateShortAttribute()
  {   
    return date('d.m.Y', strtotime($this->date));
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
   * Get the course 'online' attribute depending on whether the event 
   * has 'online' set. If not, take the 'fee' of the parent course 
   *
   * @param  string $value
   * @return string $date
   */

  public function getCourseOnlineAttribute($value)
  {   
    return $this->online ? $this->online : $this->course->online;
  }

  /**
   * Get array of ids from the m:n relationships
   *
   */

  public function getExpertIdsAttribute()
  {
    return $this->experts->pluck('id');
  }

  /**
   * Get all users for an event. Users do not have a direct
   * relationship with events, they are related via the
   * booking.
   * 
   * @return Array $users
   */

  public function getStudents()
  {
    return $this->bookings->pluck('user')->all();
  }

  /**
   * Get the event number attribute. The event number is a combination
   * of the events course and the first date of the event.
   *
   * @return String $number
   */

  public function getNumberAttribute()
  {
    return str_pad($this->course->number,  2, "0", STR_PAD_LEFT) . '-' . date('dmy', strtotime($this->date));
  }

}
