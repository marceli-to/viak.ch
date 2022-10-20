<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamMember extends Base
{
  use HasTranslations, SoftDeletes;


  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  
  protected $casts = [
    'title' => 'array',
    'info' => 'array',
  ];

  /**
   * The model's default values for attributes.
   *
   * @var array
   */

  protected $attributes = [
    'title' => '{
      "de": "null", "en": "null"
    }',
    'info' => '{
      "de": "null", "en": "null"
    }',
  ];
  
  /**
   * The attributes that are translatable.
   *
   * @var array
   */

  public $translatable = [
    'title',
    'info',
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   
	protected $fillable = [
    'uuid',
    'firstname',
    'name',
    'title',
    'info',
    'publish',
    'order'
  ];


  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */

  protected $hidden = [];

  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */

  protected $appends = [
    'fullname',
  ];

  /*
  |--------------------------------------------------------------------------
  | Relationships
  |--------------------------------------------------------------------------
  |
  |
  */

  public function image()
  {
    return $this->morphOne(Image::class, 'imageable');
  }


  public function publishedImage()
  {
    return $this->morphOne(Image::class, 'imageable')->where('publish', 1);
  }


  public function images()
  {
    return $this->morphMany(Image::class, 'imageable');
  }
  
  
  /**
   * Get the members full name.
   *
   * @param  string  $value
   * @return string
   */

  public function getFullnameAttribute($value)
  {
    return trim("{$this->firstname} {$this->name}");
  }
}
