<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Course extends Base
{
  use HasTranslations, Searchable, SoftDeletes;

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
    'short_description' => '{
      "de": "null", "en": "null"
    }',
    'full_description' => '{
      "de": "null", "en": "null"
    }',
    'additional_information' => '{
      "de": "null", "en": "null"
    }',
    'additional_information_1' => '{
      "de": "null", "en": "null"
    }',
    'summary' => '{
      "de": "null", "en": "null"
    }',
    'facts_column_1' => '{
      "de": "null", "en": "null"
    }',
    'facts_column_2' => '{
      "de": "null", "en": "null"
    }',
    'facts_column_3' => '{
      "de": "null", "en": "null"
    }',
    'seo_description' => '{
      "de": null, "en": null
    }',
    'seo_tags' => '{
      "de": null, "en": null
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
    'short_description',
    'full_description',
    'additional_information',
    'additional_information_1',
    'summary',
    'facts_column_1',
    'facts_column_2',
    'facts_column_3',
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
    'number',
    'course',
    'title',
    'subtitle',
    'short_description',
    'full_description',
    'additional_information',
    'additional_information_1',
    'summary',
    'facts_column_1',
    'facts_column_2',
    'facts_column_3',
    'fee',
    'reviews',
    'seo_description',
    'seo_tags',
    'order',
    'online',
    'publish'
  ];

  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */

  protected $appends = [
    'course_number',
    'category_ids',
    'language_ids',
    'level_ids',
    'software_ids',
    'tag_ids',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */

  protected $hidden = [];


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


  /**
   * Check for upcoming, published events
   * 
   * @return Boolean
   */

  public function hasUpcomingAndPublishedEvents()
  {
    return $this->upcomingAndPublishedEvents()->count() > 0 ? TRUE : FALSE;
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
    return $this->hasMany(Event::class)->where('date', '>', $constraint)->notFlagged('isCancelled')->orderBy('date', 'ASC');
  }

  /**
   * The upcoming events that are published and not cancelled 
   * and that belong to this course.
   */
  
  public function upcomingAndPublishedEvents()
  {
    $constraint = date('Y-m-d', time());
    return $this->hasMany(Event::class)->where('date', '>', $constraint)->notFlagged('isCancelled')->where('publish', 1)->orderBy('date', 'ASC');
  }

  /**
   * The past events that belong to this course.
   */
  
  public function pastEvents()
  {
    $constraint = date('Y-m-d', time());
    return $this->hasMany(Event::class)->where('date', '<', $constraint)->orderBy('date', 'ASC');
  }

  /**
   * The image(s) that belong to this course.
   */
  
   public function teaserImage()
  {
    return $this->morphOne(Image::class, 'imageable')->where('type', 'teaser')->where('publish', 1);
  }

  public function visualImage()
  {
    return $this->morphOne(Image::class, 'imageable')->where('type', 'visual')->where('publish', 1);
  }

  public function visualImages()
  {
    return $this->morphMany(Image::class, 'imageable')->where('type', 'visual')->where('publish', 1)->orderBy('order');
  }

  public function openGraphImage()
  {
    return $this->morphOne(Image::class, 'imageable')->where('type', 'open-graph')->where('publish', 1);
  }


  public function image()
  {
    return $this->morphOne(Image::class, 'imageable');
  }

  public function images()
  {
    return $this->morphMany(Image::class, 'imageable')->orderBy('order');
  }

  /**
   * The videos that belong to this course.
   */
  
  public function videos()
  {
    return $this->hasMany(CourseVideo::class);
  }

  public function publishedVideos()
  {
    return $this->hasMany(CourseVideo::class)->where('publish', 1);
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

  /**
   * Get the courses number attribute as a padded string.
   *
   * @param  string  $value
   * @return string
   */

  public function getCourseNumberAttribute($value)
  {
    return str_pad($this->number,  2, "0", STR_PAD_LEFT);
  }

  /**
   * Get array of ids from the m:n relationships
   *
   */

  public function getCategoryIdsAttribute()
  {
    return $this->categories->pluck('id');
  }

  public function getLanguageIdsAttribute()
  {
    return $this->languages->pluck('id');
  }

  public function getLevelIdsAttribute()
  {
    return $this->levels->pluck('id');
  }

  public function getSoftwareIdsAttribute()
  {
    return $this->softwares->pluck('id');
  }

  public function getTagIdsAttribute()
  {
    return $this->tags->pluck('id');
  }
}
