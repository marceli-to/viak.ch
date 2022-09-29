<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Http\Resources\StudentEventResource;
use App\Http\Resources\BookingResource;
use App\Models\User;
use App\Models\Event;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Requests\StudentUpdateRequest;

class StudentController extends Controller
{
  /**
   * Get a student with:
   * 
   * - Bookings
   * - Bookmarks
   * - Documents
   * 
   * @return \Illuminate\Http\Response
   */
  public function find()
  { 
    $data = new StudentResource(User::findOrFail(auth()->user()->id));
    return response()->json($data);
  }

  /**
   * Update a student
   * 
   * @param StudentUpdateRequest $request
   * @return \Illuminate\Http\Response
   */
  public function update(StudentUpdateRequest $request)
  { 
    $user = User::findOrFail(auth()->user()->id);

    // Update user data (without password)
    $user->update($request->except([
      'email', 'password', 'operating_system'
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
