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
  public function find($map = FALSE)
  { 
    $user = User::findOrFail(auth()->user()->id);
    return response()->json($map ? $this->map($user) : $user);
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

  /**
   * Map data for JSON output
   * 
   * @param User user
   * @return Array
   */
  private function map(User $user)
  {
    return [
      'uuid' => $user->uuid,
      'name' => $user->name,
      'firstname'  => $user->firstname,
      'fullname'  => $user->fullname,
      'address' => $user->address,
      'invoice_address' => $user->invoice_address,
      'email' => $user->email,
      'phone' => $user->phone,
    ];
  }

}
