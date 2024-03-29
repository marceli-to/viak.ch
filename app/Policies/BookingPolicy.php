<?php
namespace App\Policies;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can view the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Booking  $booking
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function view(User $user, Booking $booking)
  {
    return $user->id === $booking->user_id || auth()->user()->isAdmin();
  }

  /**
   * Determine whether the user can view the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Booking  $booking
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function viewEvent(User $user, Booking $booking)
  {
    return $user->id === $booking->user_id || auth()->user()->isAdmin();
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Booking  $booking
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function cancel(User $user, Booking $booking)
  {
    return $user->id === $booking->user_id || auth()->user()->isAdmin();
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Booking  $booking
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function update(User $user, Booking $booking)
  {
    //
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Booking  $booking
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function delete(User $user, Booking $booking)
  {
    //
  }

  /**
   * Determine whether the user can restore the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Booking  $booking
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function restore(User $user, Booking $booking)
  {
    //
  }

  /**
   * Determine whether the user can permanently delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Booking  $booking
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function forceDelete(User $user, Booking $booking)
  {
    //
  }
}
