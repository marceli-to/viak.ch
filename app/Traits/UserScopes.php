<?php
namespace App\Traits;
use App\Models\Role;

trait UserScopes
{

  /**
   * The scope for published users.
   * 
   * @param  \Illuminate\Database\Eloquent\Builder $query
   * @return \Illuminate\Database\Eloquent\Builder
   * 
   */

  public function scopePublished($query)
  {
    return $query->where('publish', 1);
  }

 /**
  * The scope for not published users.
  *
  * @param  \Illuminate\Database\Eloquent\Builder $query
  * @return \Illuminate\Database\Eloquent\Builder
  * 
  */

  public function scopeUnpublished($query)
  {
    return $query->where('publish', 0);
  }

 /**
  * The scope for visible users.
  * 
  * @param  \Illuminate\Database\Eloquent\Builder $query
  * @return \Illuminate\Database\Eloquent\Builder
  */

  public function scopeVisible($query)
  {
    return $query->where('visible', 1);
  }

 /**
  * The scope for hidden users.
  * 
  * @param  \Illuminate\Database\Eloquent\Builder $query
  * @return \Illuminate\Database\Eloquent\Builder
  */

  public function scopeHidden($query)
  {
    return $query->where('visible', 0);
  }

 /**
  * Scope a query to only include users with role 'admin'.
  *
  * @param  \Illuminate\Database\Eloquent\Builder  $query
  * @return \Illuminate\Database\Eloquent\Builder
  */
  public function scopeAdmins($query)
  {
    return $query->whereHas('roles', function ($q) {
      $q->where('role_id', Role::ADMIN);
    });
  }

  /**
  * Scope a query to only include users with role 'admin'.
  *
  * @param  \Illuminate\Database\Eloquent\Builder  $query
  * @return \Illuminate\Database\Eloquent\Builder
  */
  public function scopeExperts($query)
  {
    return $query->whereHas('roles', function ($q) {
      $q->where('role_id', Role::EXPERT);
    });
  }

  /**
  * Scope a query to only include users with role 'student'.
  *
  * @param  \Illuminate\Database\Eloquent\Builder  $query
  * @return \Illuminate\Database\Eloquent\Builder
  */
  public function scopeStudents($query)
  {
    return $query->whereHas('roles', function ($q) {
      $q->where('role_id', Role::STUDENT);
    });
  }
  
  /**
   * Scope a query to search a user
   *
   * @param  \Illuminate\Database\Eloquent\Builder $query
   * @return \Illuminate\Database\Eloquent\Builder
   */

  public function scopeSearch($query, $search)
  {
    return $query->where('name', 'LIKE', "%$search%")
      ->orWhere('firstname', 'LIKE', "%$search%")
      ->orWhere('email', 'LIKE', "%$search%")
      ->orWhere('company', 'LIKE', "%$search%")
      ->get();
  }
}