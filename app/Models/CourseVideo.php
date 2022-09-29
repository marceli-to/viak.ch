<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;

class CourseVideo extends Base
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   
	protected $fillable = [
    'uuid',
    'title',
    'code',
    'order',
    'publish',
    'course_id',
  ];

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



  /*
  |--------------------------------------------------------------------------
  | Local scopes
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   * Scope a query to only include published videos
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopePublished($query)
  {
    return $query->where('publish', 1);
  }
}
