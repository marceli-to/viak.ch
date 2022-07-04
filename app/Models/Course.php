<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
  use HasFactory;

  /**
   * The categories that belong to this course
   */
  
  public function categories()
  {
    return $this->belongsToMany(Category::class);
  }

  /**
   * The softwares that belong to this course
   */
  
  public function softwares()
  {
    return $this->belongsToMany(Software::class);
  }

  /**
   * The tags that belong to this course
   */
  
  public function tags()
  {
    return $this->belongsToMany(Tag::class);
  }

}
