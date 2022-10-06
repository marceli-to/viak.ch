<?php
namespace App\Models;
use App\Models\Base;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Base
{
  use SoftDeletes;

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
    'country_id',
    'user_id'
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


  /*
  |--------------------------------------------------------------------------
  | Relationships
  |--------------------------------------------------------------------------
  |
  |
  */

  /**
   * The user that belong to this address.
   */

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  /**
   * The country that belongs to this user.
   */

  public function country()
  {
    return $this->hasOne(Country::class, 'id', 'country_id');
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

    if ($this->firstname || $this->name)
    {
      $address .= "{$this->fullname}<br>";
    }
    $address .= "{$this->street} {$this->street_no}<br>";
    $address .= "{$this->zip} {$this->city}";

    if ($this->country_id !== Country::HOME)
    {
      $address .= "<br>";
      $address .= Country::find($this->country_id)->name;
    }

    return $address;
  }

}
