<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Requests\StudentUpdateRequest;

class StudentController extends Controller
{
  /**
   * Find a user
   * 
   * @return \Illuminate\Http\Response
   */
  public function find($map = FALSE)
  { 
    /**
     * @todo: if admin get the full user
     * $user = User::findOrFail(auth()->user()->id);
     */
    $data = new StudentResource(User::findOrFail(auth()->user()->id));
    //dd($data);
    return response()->json(new StudentResource(User::findOrFail(auth()->user()->id)));
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
   * Map user data for JSON output
   * 
   * @param User user
   * @return Array
   */
  private function mapUser(User $user)
  {
    return [
      'uuid' => $user->uuid,
      'name' => $user->name,
      'firstname'  => $user->firstname,
      'fullname'  => $user->fullname,
      'address' => $user->address,
      'invoice_address' => $user->invoice_address,
      'has_invoice_address' => $user->has_invoice_address,
      'email' => $user->email,
      'phone' => $user->phone,
    ];
  }

}
