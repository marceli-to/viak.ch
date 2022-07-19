<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StudentUpdateRequest;

class StudentController extends Controller
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
   * @param StudentUpdateRequest $request
   * @return \Illuminate\Http\Response
   */
  public function update(StudentUpdateRequest $request)
  { 
    $user = User::findOrFail(auth()->user()->id);
    $user->update($request->except([
      'email', 'password', 'operating_system'
    ]));
    $user->save();
    return response()->json($user->uuid);
  }

}
