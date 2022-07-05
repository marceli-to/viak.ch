<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoryCourse extends Pivot
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  protected $fillable = [
    'category_id',
    'course_id'
  ];
}
