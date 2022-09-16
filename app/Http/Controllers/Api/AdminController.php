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
    return response()->json($user->uuid);
  }

}
