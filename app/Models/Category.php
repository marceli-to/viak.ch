<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends Base
{
  use HasTranslations, SoftDeletes;

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
    'description' => 'array',
  ];

  /**
   * The model's default values for attributes.
   *
   * @var array
   */

  protected $attributes = [
    'description' => '{
      "de": "null", 
      "en": "null"
    }'
  ];

  /**
   * The attributes that are translatable.
   *
   * @var array
   */

  public $translatable = [
    'description'
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  protected $fillable = [
    'description',
    'uuid'
  ];

  /**
   * The courses that belong to this category
   */
  
  public function courses()
  {
    return $this->belongsToMany(Course::class);
  }

}
