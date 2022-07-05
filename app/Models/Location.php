<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Location extends Model
{
  use HasFactory, HasTranslations;
  
  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  
  protected $casts = [
    'description' => 'array',
    'address' => 'array',
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
    }',
    'address' => '{
      "de": "null",
      "en": "null"
    }',
  ];
  
  /**
   * The attributes that are translatable.
   *
   * @var array
   */

  public $translatable = [
    'description',
    'address'
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

   protected $fillable = [
    'description',
    'address',
    'map',
    'publish',
  ];
}
