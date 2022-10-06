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

}
