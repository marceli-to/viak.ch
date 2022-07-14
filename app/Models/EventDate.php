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
   * The event for this event date.
   */

  public function event()
  {
    return $this->belongsTo(Event::class);
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
    return date('d. F Y', strtotime($value));
  }
  
}
