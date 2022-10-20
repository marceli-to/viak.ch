<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Base
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

	protected $fillable = [
    'title',
    'slug',
    'publish',
    'uuid'
  ];


  /*
  |--------------------------------------------------------------------------
  | Relationships
  |--------------------------------------------------------------------------
  |
  |
  */
  
  public function images()
  {
    return $this->morphMany(Image::class, 'imageable');
  }
 
  public function publishedImages()
  {
    return $this->morphMany(Image::class, 'imageable')->where('publish', 1);
  }

  public function publishedImage()
  {
    return $this->morphOne(Image::class, 'imageable')->where('publish', 1);
  }

}
