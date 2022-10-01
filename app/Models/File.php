<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Base
{
  use HasFactory, SoftDeletes;

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
    'orientation',
    'order',
    'publish',
    'locked',
    'fileable_id',
    'fileable_type'
  ];

  /**
   * Relationships
   * 
   */

  public function fileable()
  {
    return $this->morphTo();
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
