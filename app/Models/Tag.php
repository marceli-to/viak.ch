<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
  use HasFactory;

	protected $fillable = [
    'description',
  ];

  /**
   * The courses that belong to this software
   */
  
  public function courses()
  {
    return $this->belongsToMany(Course::class);
  }

}
