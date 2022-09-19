<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AdminUpdateRequest;

class AdminController extends Controller
{
  /**
   * Find a user by the authenticated user
   * 
   * @return \Illuminate\Http\Response
   */
  public function find()
  { 
    $user = User::findOrFail(auth()->user()->id);
    return response()->json($user);
  }

/**
   * Update a user
   * 
   * @param AdminUpdateRequest $request
   * @return \Illuminate\Http\Response
   */
  public function update(AdminUpdateRequest $request)
  { 
    $user = User::findOrFail(auth()->user()->id);
    $user->update($request->except([
      'email', 'password'
    ]));
    $user->save();

    // Update password (if set)
    if ($request->input('new_password') && $request->input('new_password_confirmation'))
    {
      $user->password = \Hash::make($request->input('new_password'));
      $user->save();
    }

    // Update email (if set)
    if ($request->input('new_email'))
    {
      $user->email = $request->input('new_email');
      $user->save();
    }

    return response()->json($user->uuid);
  }

}
