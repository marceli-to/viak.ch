<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseCategory extends Pivot
{
  protected $table = 'course_category';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  protected $fillable = [
    'course_id', 
    'category_id'
  ];
}
