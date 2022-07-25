<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
  use Notifiable, SoftDeletes;
  
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
    'street',
    'street_no',
    'zip',
    'city',
    'phone',
    'has_invoice_address',
    'invoice_address',
    'expert_title',
    'expert_description',
    'expert_bio',
    'operating_system',
    'email', 
    'password',
    'gender_id',
    'publish',
    'visible',
  ];

  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */

  protected $appends = [
    'fullname',
    'address', 
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */

  protected $hidden = [
    'password', 
    'remember_token',
  ];


  /*
  |--------------------------------------------------------------------------
  | Relationships
  |--------------------------------------------------------------------------
  |
  |
  */


  /**
   * The image(s) that belong to this user.
   */

  public function image()
  {
    return $this->morphOne(Image::class, 'imageable'); // ->where('publish', 1);
  }

  public function images()
  {
    return $this->morphMany(Image::class, 'imageable');
  }

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
   * The gender that belongs to this user.
   */

  public function bookings()
  {
    return $this->hasMany(Booking::class);
  }


  /*
  |--------------------------------------------------------------------------
  | Local scopes
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   * The scope for published users.
   * 
   */
  
	public function scopePublished($query)
	{
		return $query->where('publish', '1');
	}

  /**
   * The scope for visible users.
   * 
   */
  
	public function scopeVisible($query)
	{
		return $query->where('visible', '1');
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
      $q->where('role_id', Role::ADMIN);
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
      $q->where('role_id', Role::EXPERT);
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
      $q->where('role_id', Role::STUDENT);
    });
  }


  /*
  |--------------------------------------------------------------------------
  | Helpers
  |--------------------------------------------------------------------------
  |
  |
  */

  
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
   * Check for an admin
   * 
   * @return Boolean
   */

  public function isAdmin()
  {
    return $this->roles->contains(Role::ADMIN);
  }

  /**
   * Check for an expert
   * 
   * @return Boolean
   */

  public function isExpert()
  {
    return $this->roles->contains(Role::EXPERT);
  }

  /**
   * Check for a student
   * 
   * @return Boolean
   */

  public function isStudent()
  {
    return $this->roles->contains(Role::STUDENT);
  }

  /**
   * Get all courses for a user. This is only
   * applicable for users with the role 'expert'
   * 
   * @param  User $user
   * @return Event $event
   */

  public function getCourses(User $user)
  {
    return $user->events()->with('course')->get();
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
  
  /**
   * Get the user's address as html-string
   *
   * @param  string  $value
   * @return string
   */

  public function getAddressAttribute($value)
  {
    $address  = "{$this->firstname} {$this->name}<br>";
    $address .= "{$this->street} {$this->street_no}<br>";
    $address .= "{$this->zip} {$this->city}";
    return $address;
  }

}
