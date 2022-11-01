<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDocument extends Base
{
  use SoftDeletes;

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  
  protected $casts = [
    'date'       => 'date:d.m.Y',
    'created_at' => 'datetime:d.m.Y',
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

	protected $fillable = [
    'uuid',
    'date',
    'name',
    'type',
    'uri',
    'user_id',
    'fileable_id',
    'fileable_type'
  ];

  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */

  protected $appends = [
    'date_short',
  ];


  /**
   * Relationships
   * 
   */

  public function fileable()
  {
    return $this->morphTo();
  }

  /**
   * The user that belong to this address.
   */

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  /**
   * The booking that belongs to this document.
   */

  public function booking()
  {
    return $this->belongsTo(Booking::class, 'fileable_id');
  }

  /**
   * The invoice that belongs to this document.
   */

  public function invoice()
  {
    return $this->belongsTo(Invoice::class, 'fileable_id');
  }

  /**
   * Get the short version for an document date.
   *
   * @param  string $value
   * @return string $date
   */

  public function getDateShortAttribute()
  {   
    return date('d.m.Y', strtotime($this->date));
  }

}
