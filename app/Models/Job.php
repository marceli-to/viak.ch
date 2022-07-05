<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   
	protected $fillable = [
    'recipient',
    'processed',
    'error',
    'mailable_id',
    'mailable_type',
    'mailable_class'
  ];

  public function mailable()
  {
    return $this->morphTo();
  }

  /**
   * The scope for unprocessed jobs.
   * 
   */
	public function scopeUnprocessed($query)
	{
		return $query->where('processed', 0);
	}

}
