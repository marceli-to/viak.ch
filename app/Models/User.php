<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;

class User extends Authenticatable implements MustVerifyEmail
{
  use Notifiable;
  
  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];
  
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  protected $fillable = [
    'uuid', 
    'firstname', 
    'name', 
    'email', 
    'password',
    'gender_id',
    'data',
  ];

  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */

  protected $appends = [
    'fullname'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */

  protected $hidden = [
    'password', 
    'remember_token'
  ];

  /**
   * The roles that belong to this user.
   */

  public function roles()
  {
    return $this->belongsToMany(Role::class);
  }

  /**
   * The events that belong to this user.
   */

  public function events()
  {
    return $this->belongsToMany(Event::class);
  }

  /**
   * The gender that belongs to this user.
   */

  public function gender()
  {
    return $this->hasOne(Gender::class, 'id', 'gender_id');
  }

  /**
   * Scope a query to only include users with role 'admin'.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeAdmins($query)
  {
    return $query->whereHas('roles', function ($q) {
      $q->where('role_id', \App\Models\Role::ADMIN);
    });
  }

  /**
   * Scope a query to only include users with role 'admin'.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeExperts($query)
  {
    return $query->whereHas('roles', function ($q) {
      $q->where('role_id', \App\Models\Role::EXPERT);
    });
  }  

  /**
   * Scope a query to only include users with role 'student'.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeStudents($query)
  {
    return $query->whereHas('roles', function ($q) {
      $q->where('role_id', \App\Models\Role::STUDENT);
    });
  }

  /**
   * Check for multiple roles.
   * 
   * @return Boolean
   */

  public function hasMultipleRoles()
  {
    return $this->roles->count() > 1 ? TRUE : FALSE;
  }

  /**
   * Check for a single role by role.
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

  public function getFullnameAttribute($value)
  {
    return "{$this->firstname} {$this->name}";
  }
}
