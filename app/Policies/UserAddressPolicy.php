<?php
namespace App\Policies;
use App\Models\UserAddress;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserAddressPolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can view the model.
   *
   * @param  \App\Models\User $user
   * @param  \App\Models\UserAddress $userAddress
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function view(User $user, UserAddress $userAddress)
  {
    return $user->id === $userAddress->user_id;
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User $user
   * @param  \App\Models\UserAddress $userAddress
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function update(User $user, UserAddress $userAddress)
  {
    return $user->id === $userAddress->user_id;
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\Models\User $user
   * @param  \App\Models\UserAddress $userAddress
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function delete(User $user, UserAddress $userAddress)
  {
    return $user->id === $userAddress->user_id;
  }

  /**
   * Determine whether the user can restore the model.
   *
   * @param  \App\Models\User $user
   * @param  \App\Models\UserAddress $userAddress
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function restore(User $user, UserAddress $userAddress)
  {
    return $user->id === $userAddress->user_id;
  }

  /**
   * Determine whether the user can permanently delete the model.
   *
   * @param  \App\Models\User $user
   * @param  \App\Models\UserAddress $userAddress
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function forceDelete(User $user, UserAddress $userAddress)
  {
    return $user->id === $userAddress->user_id;
  }
}
