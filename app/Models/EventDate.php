<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class EventDate extends Base
{
  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */

  protected $casts = [
    'date' => 'date:d.m.Y',
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   
	protected $fillable = [
    'date',
    'time_start',
    'time_end',
    'event_id',
  ];

  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */

  protected $appends = [
    'date_short',
  ];


  /**
   * The event for this event date.
   */

  public function event()
  {
    return $this->belongsTo(Event::class);
  }

  /**
   * Set the date for an event_date.
   *
   * @param  string $value
   * @return void
   */

  public function setDateAttribute($value)
  {
    $this->attributes['date'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
  }

  /**
   * Set the time_start for an event_date.
   *
   * @param  string $value
   * @return void
   */

  public function setTimeStartAttribute($value)
  {
    $value = $value . '.00';
    $this->attributes['time_start'] = \Carbon\Carbon::parse($value)->format('H:i');
  }

  /**
   * Set the time_end for an event_date.
   *
   * @param  string $value
   * @return void
   */

  public function setTimeEndAttribute($value)
  {
    $value = $value . '.00';
    $this->attributes['time_end'] = \Carbon\Carbon::parse($value)->format('H:i');
  }

  /**
   * Get the time_start for an event_date.
   *
   * @param  string $value
   * @return string $time_start
   */

  public function getTimeStartAttribute($value)
  {   
    return date('H.i', strtotime($value));
  }

  /**
   * Get the time_end for an event_date.
   *
   * @param  string $value
   * @return string $time_start
   */

  public function getTimeEndAttribute($value)
  {   
    return date('H.i', strtotime($value));
  }

  /**
   * Get the date for an event_date.
   *
   * @param  string $value
   * @return string $date
   */

  public function getDateAttribute($value)
  {   
    return \Carbon\Carbon::parse($value)->translatedFormat('d. F Y');
  }

  /**
   * Get the date for an event_date.
   *
   * @param  string $value
   * @return string $date
   */

  public function getDateStrAttribute($value)
  {   
    return \Carbon\Carbon::parse($this->date)->translatedFormat('d. F Y');
  }

  /**
   * Get the date for an event_date.
   *
   * @param  string $value
   * @return string $date
   */

  public function getDateShortAttribute()
  {   
    return \Carbon\Carbon::parse($this->date)->format('d.m.Y');
    //return date('d.m.Y', strtotime($this->date));
  }
}
