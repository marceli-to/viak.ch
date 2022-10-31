<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelFlags\Models\Concerns\HasFlags;

class DiscountCode extends Base
{
  use SoftDeletes, HasFlags;

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
    return $query->notFlagged('isUsed')->where(function($query) use ($constraint) {
      $query->where('valid_to', '>', $constraint)->OrWhereNull('valid_to');
    });
	}

	/**
   * Used discount codes
   */

	public function scopeUsed($query)
	{
    $constraint = date('Y-m-d', time());
    return $query->flagged('isUsed')->OrWhere(function($query) use ($constraint) {
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
    if ($this->hasFlag('isUsed'))
    {
      return FALSE;
    }

    if ($this->valid_from && $this->valid_to)
    {
      $valid_from = strtotime($this->valid_from);
      $valid_to = strtotime($this->valid_to);
      $now = time();

      if ($now >= $valid_from && $now <= $valid_to)
      {
        return TRUE;
      }

      return FALSE;
    }

    return TRUE;
  }

  /**
   * Check if the code is for single time use only
   * 
   * @return Boolean
   */

  public function isSingle()
  {
    if ($this->valid_from && $this->valid_to)
    {
      return FALSE;
    }
    return TRUE;
  }

  /**
   * Check if the code can be used multiple times
   * 
   * @return Boolean
   */

  public function isMulti()
  {
    if ($this->valid_from && $this->valid_to)
    {
      return TRUE;
    }
    return FALSE;
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
