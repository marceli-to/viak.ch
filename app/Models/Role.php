<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  use HasFactory;
	  
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'uuid', 'name', 'key'
  ];

  /**
   * The users that belong to this role
   */

  public function users()
  {
    return $this->belongsToMany(User::class);
  }
}
