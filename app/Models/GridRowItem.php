<?php
namespace App\Models;
use App\Models\Base;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class GridRowItem extends Base
{
  use HasTranslations;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  protected $fillable = [
    'title',
    'course_id',
    'news_id',
    'grid_row_id',
    'code',
    'ratio',
    'position'
  ];

  /**
   * The model's default values for attributes.
   *
   * @var array
   */

  protected $attributes = [
    'title' => '{
      "de": null, "en": null
    }',
  ];

  /**
   * The attributes that are translatable.
   *
   * @var array
   */

  public $translatable = [
    'title',
  ];

  /*
  |--------------------------------------------------------------------------
  | Helpers
  |--------------------------------------------------------------------------
  |
  |
  */
  
  /**
   * Check for an empty item
   * 
   * @param Role $role
   * @return Boolean
   */

  public function isEmpty()
  {
    return $this->course_id == NULL && $this->news_id == NULL && $this->code == NULL ? TRUE : FALSE;
  }

  /*
  |--------------------------------------------------------------------------
  | Relationships
  |--------------------------------------------------------------------------
  |
  |
  */

  public function row()
  {
    return $this->belongsTo(GridRow::class);
  }

  public function news()
  {
    return $this->hasOne(News::class, 'id', 'news_id');
  }

  public function course()
  {
    return $this->hasOne(Course::class, 'id', 'course_id');
  }
}
