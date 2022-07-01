<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;

class User extends Authenticatable implements MustVerifyEmail
{
  use Notifiable, HasFactory;
  
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'uuid', 'firstname', 'name', 'email', 'password'
  ];

  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */
  protected $appends = ['full_name'];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token'
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  /**
   * The roles that belong to this user
   */
  public function roles()
  {
    return $this->belongsToMany(Role::class);
  }

  /**
   * Check for multiple roles
   * @return Boolean
   */

  public function hasMultipleRoles()
  {
    return $this->roles->count() > 1 ? TRUE : FALSE;
  }

  /**
   * Check for a single role by role
   * 
   * @param Role $role
   * @return Boolean
   */

  public function hasRole(Role $role)
  {
    return $this->roles->contains($role->id);
  }

  /**
   * Check for at least one role by an array of roles
   * 
   * @param Array $roles
   * @return Boolean
   */

  public function hasAtLeastOneRole($roles)
  {
    foreach($roles as $role)
    {
      $r = Role::where('key', $role)->firstOrFail();
      if ($this->roles->contains($r->id))
      {
        return TRUE;
      }
    }
    return FALSE;
  }

  /**
   * Get the user's full name.
   *
   * @param  string  $value
   * @return string
   */
  public function getFullNameAttribute($value)
  {
    return $this->firstname . ' ' . $this->name;
  }
}
