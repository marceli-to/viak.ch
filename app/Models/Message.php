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
   * The gender that belongs to this user.
   */

  public function gender()
  {
    return $this->hasOne(Gender::class, 'id', 'gender_id');
  }

}
