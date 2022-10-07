<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountCode extends Base
{
  use SoftDeletes;

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */

  protected $casts = [
    'valid_from' => 'date:d.m.Y',
    'valid_to' => 'date:d.m.Y',
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   
	protected $fillable = [
    'code',
    'amount',
    'valid_from',
    'valid_to',
    'fix',
    'percent',
    'used',
    'uuid',
  ];

  /*
  |--------------------------------------------------------------------------
  | Local scopes
  |--------------------------------------------------------------------------
  |
  |
  */

	/**
   * Unused discount codes
   */

	public function scopeUnused($query)
	{
    $constraint = date('Y-m-d', time());
    return $query->where('used', 0)->where(function($query) use ($constraint) {
      $query->where('valid_to', '>', $constraint)->OrWhereNull('valid_to');
    });
	}

	/**
   * Used discount codes
   */

	public function scopeUsed($query)
	{
    $constraint = date('Y-m-d', time());
    return $query->where('used', 1)->OrWhere(function($query) use ($constraint) {
      $query->where('valid_to', '<', $constraint)->whereNotNull('valid_to');
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
   * Check it the code is valid
   * 
   * @return Boolean
   */

  public function isValid()
  {
    if ($this->used == 1)
    {
      return FALSE;
    }

    // if ($this->valid_from && $this->valid_to)
    // {
    //   return \Carbon\Carbon::now()->between(
    //     \Carbon\Carbon::createFromFormat('d.m.Y', $this->valid_from), 
    //     \Carbon\Carbon::createFromFormat('d.m.Y', $this->valid_to)
    //   );
    // }

    return TRUE;
  }

  /**
   * Set the valid_from date
   *
   * @param  string $value
   * @return void
   */

  public function setValidFromAttribute($value)
  {
    $this->attributes['valid_from'] = $value ? \Carbon\Carbon::parse($value)->format('Y-m-d') : NULL;
  }

  /**
   * Set the valid_to date
   *
   * @param  string $value
   * @return void
   */

  public function setValidToAttribute($value)
  {
    $this->attributes['valid_to'] = $value ? \Carbon\Carbon::parse($value)->format('Y-m-d') : NULL;
  }

}
