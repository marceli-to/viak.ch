<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;

class File extends Base
{

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */

  protected $casts = [
    'created_at' => "datetime:d.m.Y",
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
    'caption',
    'description',
    'order',
    'publish',
    'locked',
    // 'fileable_id',
    // 'fileable_type'
  ];

  /**
   * Relationships
   * 
   */

  // public function fileable()
  // {
  //   return $this->morphTo();
  // }

  /**
   * Get all of the messages that are assigned this file.
   */
  
  public function messages()
  {
    return $this->morphedByMany(Message::class, 'fileable');
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
}
