<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelFlags\Models\Concerns\HasFlags;

class Event extends Base
{
  use SoftDeletes, HasFlags;

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
    'closed_at'           => 'date:d.m.Y',
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
  ];

  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */

  protected $appends = [
    'number',
    'date_short',
    'date_long',
    'course_fee',
    'course_online',
    'expert_ids',
    'is_past',
    'is_upcoming',
    'is_confirmed',
    'is_cancelled',
    'is_closed',
  ];


  /*
  |--------------------------------------------------------------------------
  | Helpers
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   * Check for online event
   * 
   * @return Boolean
   */

  public function isOnline()
  {
    return $this->online == 1 ? TRUE : FALSE;
  }

  /**
   * Check for confirmed event
   * 
   * @return Boolean
   */

  public function isConfirmed()
  {
    return $this->hasFlag('isConfirmed');
  }

  /**
   * Check for cancelled event
   * 
   * @return Boolean
   */

  public function isCancelled()
  {
    return $this->hasFlag('isCancelled');
  }

  /**
   * Check for closed event
   * 
   * @return Boolean
   */

  public function isClosed()
  {
    return $this->hasFlag('isClosed');
  }

  /**
   * Check for past event
   * 
   * @return Boolean
   */

  public function isPast()
  {
    $constraint = date('Y-m-d', time());
    return $this->date < $constraint ? TRUE : FALSE;
  }

  /**
   * Check for upcoming event
   * 
   * @return Boolean
   */

  public function isUpcoming()
  {
    $constraint = date('Y-m-d', time());
    return $this->date > $constraint ? TRUE : FALSE;
  }

  /**
   * Check for fully booked
   * 
   * @return Boolean
   */

  public function isFullyBooked()
  {
    return $this->bookings->count() >= $this->max_participants ? TRUE : FALSE;
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
   * All bookings that belong to this event.
   */
  
  public function bookings()
  {
    return $this->hasMany(Booking::class, 'event_id', 'id')->notFlagged('isCancelled');
  }

  /**
   * All bookings that belong to this event.
   */
  
   public function cancelledBookings()
   {
     return $this->hasMany(Booking::class, 'event_id', 'id')->withTrashed();
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
    return $query->flagged('isCancelled')->orderBy('date', 'DESC');
  }

  /**
   * Scope a query to only include active (= not cancelled) events
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeActive($query)
  {
    return $query->notFlagged('isCancelled');
  }

  /**
   * Scope a query to only include upcoming events
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeUpcoming($query)
  { 
    $constraint = date('Y-m-d', time());
    return $query->where('date', '>=', $constraint)->orderBy('date', 'ASC');
  }

  /**
   * Scope a query to only include upcoming events
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopePast($query)
  { 
    $constraint = date('Y-m-d', time());
    return $query->where('date', '<=', $constraint)->orderBy('date', 'DESC');
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
   * Get the short version for an event date.
   *
   * @param  string $value
   * @return string $date
   */

  public function getRegistrationUntilStrAttribute()
  {   
    return date('d.m.Y', strtotime($this->registration_until));
  }


  /**
   * Get the date for an event date.
   *
   * @param  string $value
   * @return string $date
   */

  public function getDateLongAttribute()
  {   
    return date('d. F Y', strtotime($this->date));
  }

  /**
   * Get the short version for an event date.
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
   * has 'online' set. If not, take the 'online' attribute of the parent course 
   *
   * @param  string $value
   * @return string $date
   */

  public function getCourseOnlineAttribute($value)
  {   
    return $this->online ? $this->online : $this->course->online;
  }

  /**
   * Get array of ids from event experts
   *
   */

  public function getExpertIdsAttribute()
  {
    return $this->experts->pluck('id');
  }

  /**
   * Get the events experts fullnames as comma separated string
   *
   */

  public function getExpertsFullnameStringAttribute()
  {
    return collect($this->experts->pluck('fullname')->all())->implode(', ');
  }

  /**
   * Get the events dates as comma separated string
   *
   */

  public function getDatesStringAttribute()
  {
    $dates = collect($this->dates);
    return collect($dates->pluck('date_short')->all())->implode(', ');
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

  /**
   * Get the events 'is_past' state
   *
   */

  public function getIsPastAttribute()
  {
    return $this->isPast();
  }

  /**
   * Get the events 'is_upcoming' state
   *
   */

  public function getIsUpcomingAttribute()
  {
    return $this->isUpcoming();
  }

  /**
   * Get the events 'is_closed' state
   *
   */

  public function getIsConfirmedAttribute()
  {
    return $this->isConfirmed();
  }

  /**
   * Get the events 'is_closed' state
   *
   */

  public function getIsCancelledAttribute()
  {
    return $this->isCancelled();
  }

  /**
   * Get the events 'is_closed' state
   *
   */

  public function getIsClosedAttribute()
  {
    return $this->isClosed();
  }
}