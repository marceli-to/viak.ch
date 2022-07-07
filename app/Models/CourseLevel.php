<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseLevel extends Pivot
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  protected $fillable = [
    'course_id', 
    'level_id'
  ];
}
