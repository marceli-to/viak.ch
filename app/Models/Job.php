<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
  use HasFactory;

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

	public function scopeUnprocessed($query)
	{
		return $query->where('processed', 0);
	}

}
