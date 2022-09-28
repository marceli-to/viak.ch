<?php
namespace App\Policies;
use App\Models\Bookmark;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookmarkPolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can destroy a bookmark
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Booking  $booking
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function destroy(User $user, Bookmark $bookmark)
  {
    return $user->id === $bookmark->user_id;
  }

}
