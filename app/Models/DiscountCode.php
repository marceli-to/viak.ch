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
    //return $query->where('used', 0);
    $constraint = date('Y-m-d', time());

    return $query->where('used', 0)->orWhere(function($query) use ($constraint) {
      $query->where('valid_to', '>', $constraint)->whereNotNull('valid_to');
    });


    // $from = date('Y-m-d', strtotime($this->valid_from));
    // $to = date('Y-m-d', strtotime($this->valid_to));

		// return $query->where('used', 0)->orWhere(function($query) use ($from, $to) {
    //   dd($from);
    //   $query->where(function($q) use ($from) {
    //     $q->where('valid_from', '>=', $from)->orWhere('valid_from', NULL);
    //   });
    //   $query->where(function($q) use ($to) {
    //     $q->where('valid_to', '>=', $to)->orWhere('valid_to', NULL);
    //   });
    // });

	}

	/**
   * Used discount codes
   */

	public function scopeUsed($query)
	{
		return $query->where('used', 1);
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

    if ($this->valid_from && $this->valid_to)
    {
      return \Carbon\Carbon::now()->between(
        \Carbon\Carbon::createFromFormat('d.m.Y', $this->valid_from), 
        \Carbon\Carbon::createFromFormat('d.m.Y', $this->valid_to)
      );
    }

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
