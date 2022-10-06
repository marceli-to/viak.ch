<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;

class Role extends Base
{
  public const ADMIN = 1;
  public const EXPERT = 2;
  public const STUDENT = 3;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  
  protected $fillable = [
    'uuid', 'name', 'key'
  ];

  /**
   * The users that belong to this role.
   */

  public function users()
  {
    return $this->belongsToMany(User::class);
  }

}
