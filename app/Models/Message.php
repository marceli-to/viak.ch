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
    'date' => 'datetime:d.m.Y',
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

	protected $fillable = [
    'date',
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
   * The user that belongs to this message.
   */

  public function user()
  {
    return $this->hasOne(User::class, 'id', 'user_id');
  }

}
