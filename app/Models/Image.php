<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Base
{
  use SoftDeletes;

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  
  protected $casts = [
    'created_at' => 'datetime:d.m.Y',
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

	protected $fillable = [
    'uuid',
    'name',
    'original_name',
    'extension',
    'size',
    'type',
    'caption',
    'description',
    'orientation',
		'coords_w',
    'coords_h',
    'coords_x',
    'coords_y',
    'order',
    'publish',
    'locked',
    'imageable_id',
    'imageable_type'
  ];

  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */

  protected $appends = [
    'coords',
  ];

  /**
   * Relationships
   * 
   */

  public function imageable()
  {
    return $this->morphTo();
  }


  /**
   * Check for teaser image
   * 
   * @return Boolean
   */

  public function isTeaser()
  {
    return $this->type == 'teaser';
  }

  /**
   * Check for teaser image
   * 
   * @return Boolean
   */

  public function isVisual()
  {
    return $this->type == 'visual';
  }


	/**
   * Scope for published images
   */

	public function scopePublish($query)
	{
		return $query->where('publish', 1);
	}

	/**
   * Scope for locked images
   */

	public function scopeLocked($query)
	{
		return $query->where('locked', 1);
	}

	/**
	 * Get the cropping coordinates
	 *
	 * @return string
	 */

	public function getCoordsAttribute()
	{
    $coords = '0,0,0,0';
    if ($this->coords_w && $this->coords_h)
    {
      $coords = floor($this->coords_w) . ',' .  floor($this->coords_h) . ',' .  floor($this->coords_x) . ',' .  floor($this->coords_y);
    }
    return $coords;
  }

	/**
	 * Get the image ratio
	 *
	 * @return string
	 */
  
	public function getRatioAttribute()
	{
    if (($this->coords_w && $this->coords_h) && ($this->coords_w > $this->coords_h))
    {
      return 'wide';
    }
    return '';
  }
}
