<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Base extends Model
{

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  
  protected $casts = [
    'created_at' => 'date:d.m.Y',
    'updated_at' => 'date:d.m.Y',
  ];

  /**
   * The scope for published records.
   * 
   */
  
	public function scopePublished($query)
	{
		return $query->where('publish', '1');
	}
}