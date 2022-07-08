<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Laravel\Scout\Searchable;

class Course extends Base
{
  use HasTranslations, Searchable;

  /**
   * Get the name of the index associated with the model.
   *
   * @return string
   */
  
  public function searchableAs()
  {
    return 'courses';
  }

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  
  protected $casts = [
    'slug' => 'array',
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
    'slug' => '{
      "de": "null", "en": "null"
    }',
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
    'slug',
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
    'online',
    'publish'
  ];


  /*
  |--------------------------------------------------------------------------
  | Helpers
  |--------------------------------------------------------------------------
  |
  |
  */


  /**
   * Check for upcoming events
   * 
   * @return Boolean
   */

  public function hasUpcomingEvents()
  {
    return $this->upcomingEvents()->count() > 0 ? TRUE : FALSE;
  }


  /*
  |--------------------------------------------------------------------------
  | Relationships
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   * The categories that belong to this course.
   */
  
  public function categories()
  {
    return $this->belongsToMany(Category::class);
  }

  /**
   * The software that belong to this course.
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
   * The languages that belong to this course.
   */
  
  public function languages()
  {
    return $this->belongsToMany(Language::class);
  }

  /**
   * The levels that belong to this course.
   */
  
  public function levels()
  {
    return $this->belongsToMany(Level::class);
  }

  /**
   * The events that belong to this course.
   */
  
  public function events()
  {
    return $this->hasMany(Event::class);
  }

  /**
   * The upcoming events that belong to this course.
   */
  
  public function upcomingEvents()
  {
    $constraint = date('Y-m-d', time());
    return $this->hasMany(Event::class)->where('date', '>', $constraint)->orderBy('date', 'ASC');
  }


  /*
  |--------------------------------------------------------------------------
  | Local scopes
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   * Scope a query to only include online courses
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeOnline($query)
  {
    return $query->where('online', 1);
  }

  /**
   * Scope a query to only include online courses
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeOffline($query)
  {
    return $query->where('online', 0);
  }
}
