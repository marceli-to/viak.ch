<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseTag extends Pivot
{
  protected $fillable = [
    'course_id', 
    'tag_id'
  ];
}
