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
}
