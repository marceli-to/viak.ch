<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Base
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
    'subject',
    'body',
    'user_id',
    'uuid',
    'messageable_id',
    'messageable_type'
  ];

  /*
  |--------------------------------------------------------------------------
  | Relationships
  |--------------------------------------------------------------------------
  |
  |
  */

  public function messageable()
  {
    return $this->morphTo();
  }

  /**
   * Get all of the files for the message.
   */

  public function files()
  {
    return $this->morphToMany(File::class, 'fileable');
  }

  /**
   * Get the user that belongs to the message.
   */

  public function user()
  {
    return $this->hasOne(User::class, 'id', 'user_id');
  }

}
