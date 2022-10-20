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
    'description' => 'array',
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
    'description' => '{
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
    'description',
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
    'description',
    'info',
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

  public function images()
  {
    return $this->morphMany(Image::class, 'imageable');
  }

}
