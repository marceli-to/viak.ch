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
  ];


  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */

  protected $appends = [
    'uploaded_at',
  ];


  /**
   * Relationships
   * 
   */

  /**
   * Get all of the messages that are assigned this file.
   */
  
  public function messages()
  {
    return $this->morphedByMany(Message::class, 'fileable');
  }

  /**
   * Get all of the events that are assigned this file.
   */
  
  public function files()
  {
    return $this->morphedByMany(Event::class, 'fileable');
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
   * Get created_at date for a file.
   *
   * @param  string $value
   * @return string $date
   */

  public function getUploadedAtAttribute()
  {   
    return date('d.m.Y, H:i', strtotime($this->created_at));
  }
}
