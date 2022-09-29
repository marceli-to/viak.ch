<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Base
{
  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */

  protected $casts = [
    'bookmarked_at' => 'date:d.m.Y',
  ];
  
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   
	protected $fillable = [
    'uuid',
    'event_id',
    'user_id',
    'bookmarked_at',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */

  protected $hidden = [
    'user_id', 
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
