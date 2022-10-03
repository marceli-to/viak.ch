<?php
namespace App\Models;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;

class Fileable extends Base
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

	protected $fillable = [
    'file_id',
    'fileable_type',
    'fileable_id'
  ];

}
