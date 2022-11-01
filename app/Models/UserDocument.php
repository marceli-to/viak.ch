<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDocument extends Base
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
    'type',
    'uri',
    'user_id',
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
   * The user that belong to this address.
   */

  public function user()
  {
    return $this->belongsTo(User::class);
  }


	/**
   * Scope for published images
   */

	public function scopePublish($query)
	{
		return $query->where('publish', 1);
	}

}
