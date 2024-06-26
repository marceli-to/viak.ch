<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Traits\UserScopes;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
  use Notifiable, SoftDeletes, UserScopes;
  
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
    'company',
    'street',
    'street_no',
    'zip',
    'city',
    'phone',
    'expert_title',
    'expert_description',
    'expert_order',
    'operating_system',
    'subscribe_newsletter',
    'email', 
    'password',
    'temp_password',
    'confirm_token',
    'gender_id',
    'country_id',
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
    'temp_password',
    'remember_token',
    'confirm_token',
  ];


  /*
  |--------------------------------------------------------------------------
  | Relationships
  |--------------------------------------------------------------------------
  |
  |
  */


  /**
   * The images that belong to this user.
   */

  public function teaserImage()
  {
    return $this->morphOne(Image::class, 'imageable')->where('type', 'teaser')->where('publish', 1);
  }

  public function visualImage()
  {
    return $this->morphOne(Image::class, 'imageable')->where('type', 'visual')->where('publish', 1);
  }

  public function image()
  {
    return $this->morphOne(Image::class, 'imageable');
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
   * The upcoming events that belong to this user.
   */

  public function upcomingEvents()
  {
		return $this->belongsToMany(Event::class)->orderBy('date')->where('date', '>=', date('Y-m-d', time()));
  }

  /**
   * The upcoming events that belong to this user.
   */

  public function pastEvents()
  {
		return $this->belongsToMany(Event::class)->orderBy('date', 'DESC')->where('date', '<', date('Y-m-d', time()));
  }

  /**
   * The invoice addresses that belongs to this user.
   */

  public function invoiceAddresses()
  {
    return $this->hasMany(UserAddress::class);
  }

  /**
   * The gender that belongs to this user.
   */

  public function gender()
  {
    return $this->hasOne(Gender::class, 'id', 'gender_id');
  }

  /**
   * The country that belongs to this user.
   */

  public function country()
  {
    return $this->hasOne(Country::class, 'id', 'country_id');
  }

  /**
   * The bookings that belongs to this user.
   */

  public function bookings()
  {
    return $this->hasMany(Booking::class)->whereNull('cancelled_at')->notFlagged('isConcluded');
  }

  /**
   * The bookings that belongs to this user.
   */

  public function bookingsConcluded()
  {
    return $this->hasMany(Booking::class)->whereNull('cancelled_at')->flagged('isConcluded');
  }

  /**
   * The bookings that belongs to this user.
   */

  public function bookingsParticipated()
  {
    return $this->hasMany(Booking::class)->whereNull('cancelled_at')->flagged('isConcluded')->flagged('hasParticipated');
  }

  /**
   * The cancelled bookings that belongs to this user.
   */

  public function bookingsCancelled()
  {
    return $this->hasMany(Booking::class)->whereNotNull('cancelled_at');
  }

  /**
   * The bookmarks that belongs to this user.
   */

  public function bookmarks()
  {
    return $this->hasMany(Bookmark::class);
  }


  /**
   * The bookmarks that belongs to this user.
   */

  public function documents()
  {
    return $this->hasMany(UserDocument::class)->orderBy('created_at', 'DESC');
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
   * Get all courses for a user. This is only applicable for users with the role 'expert'
   * since 'students' are not listed in 'events_users' but in 'bookings'
   * 
   * @param  User $user
   * @return Event $event
   */

  public function getCourses(User $user)
  {
    $events = $user->events()->with('course')->get();
    return $events->filter(function($event) {
      return $event->date >= date('Y-m-d', time());
    });
  }
  
  /**
   * Get the user's full name.
   *
   * @param  string  $value
   * @return string
   */

  public function getFullnameAttribute($value)
  {
    return trim("{$this->firstname} {$this->name}");
  }
  
  /**
   * Get the user's address as html-string
   *
   * @param  string  $value
   * @return string
   */

  public function getAddressAttribute($value)
  {
    $address  = '';
    if ($this->company)
    {
      $address .= "{$this->company}<br>";
    }
    $address .= "{$this->firstname} {$this->name}<br>";
    $address .= "{$this->street} {$this->street_no}<br>";
    $address .= "{$this->zip} {$this->city}";
    return $address;
  }

}
