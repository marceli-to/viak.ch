<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MessageUser extends Pivot
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  protected $fillable = [
    'message_id', 
    'user_id'
  ];
}
