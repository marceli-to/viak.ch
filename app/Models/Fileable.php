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

  /**
   * Get all of the events that are assigned this file.
   */
  
  public function file()
  {
    return $this->belongsTo(File::class);
  }


}
