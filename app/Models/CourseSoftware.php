<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseSoftware extends Pivot
{
  protected $fillable = [
    'course_id', 
    'software_id'
  ];
}
