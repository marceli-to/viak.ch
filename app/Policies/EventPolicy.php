<?php
namespace App\Policies;
use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can destroy a bookmark
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Event $event
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function containsEvent(User $user, Event $event)
  {
    return $user->events->contains($event->id);
  }

}
