<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Course extends Base
{
  use HasTranslations;

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  
  protected $casts = [
    'title' => 'array',
    'subtitle' => 'array',
    'text' => 'array',
    'seo_description' => 'array',
    'seo_tags' => 'array',
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
    'subtitle' => '{
      "de": "null", "en": "null"
    }',
    'text' => '{
      "de": "null", "en": "null"
    }',
    'seo_description' => '{
      "de": "null", "en": "null"
    }',
    'seo_tags' => '{
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
    'subtitle',
    'text',
    'seo_description',
    'seo_tags'
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   
	protected $fillable = [
    'uuid',
    'title',
    'subtitle',
    'text',
    'fee',
    'reviews',
    'seo_description',
    'seo_tags',
  ];

  /**
   * The categories that belong to this course.
   */
  
  public function categories()
  {
    return $this->belongsToMany(Category::class);
  }

  /**
   * The softwares that belong to this course.
   */
  
  public function softwares()
  {
    return $this->belongsToMany(Software::class);
  }

  /**
   * The tags that belong to this course.
   */
  
  public function tags()
  {
    return $this->belongsToMany(Tag::class);
  }

  /**
   * The events that belong to this course.
   */
  
  public function events()
  {
    return $this->hasMany(Event::class, 'course_id', 'id');
  }
}
