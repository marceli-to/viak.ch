<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Base
{
  use HasTranslations, SoftDeletes;

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  
  protected $casts = [
    'created_at' => 'date:d.m.Y',
    'title' => 'array',
    'text' => 'array',
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
    'text' => '{
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
    'text',
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   
	protected $fillable = [
    'uuid',
    'title',
    'text',
    'link',
    'publish',
  ];


  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */

  protected $hidden = [];

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


  /*
  |--------------------------------------------------------------------------
  | Accessors & Mutators
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   * Mutator for link:
   * Fixes missing protocols for links
   * 
   * @param String $value
   * @return void
   */

  public function setLinkAttribute($value)
  {
    $this->attributes['link'] = (!preg_match("~^(?:f|ht)tps?://~i", $value) && $value) ? "https://" . $value : $value;
  }

  /**
   * Accessor for link:
   * Fixes missing protocols for links
   * 
   * @return String $link
   */

  public function getLinkAttribute()
  {
    return (!preg_match("~^(?:f|ht)tps?://~i", $this->attributes['link']) && $this->attributes['link']) ? "https://" . $this->attributes['link'] : $this->attributes['link'];
  }

}
