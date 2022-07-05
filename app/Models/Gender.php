<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Gender extends Base
{
  use HasTranslations;

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
      "de": "null", "en": "null"
    }',
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
    'description'
  ];

  /**
   * The users that gender belongs to.
   */

  public function users()
  {
    return $this->hasMany(User::class);
  }
}
