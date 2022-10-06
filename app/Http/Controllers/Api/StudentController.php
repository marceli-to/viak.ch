<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\User;
use App\Models\UserAddress;
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
    $data = new StudentResource(User::with('invoiceAddresses')->findOrFail(auth()->user()->id));
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

    // Update invoice_address
    if ($request->input('has_invoice_address'))
    {
      $uuid = $request->input('invoice_address.uuid') ? $request->input('invoice_address.uuid') : \Str::uuid();
      $invoice_address = UserAddress::updateOrCreate(
        ['uuid' =>$uuid],
        [
          'firstname' => $request->input('invoice_address.firstname'),
          'name' =>$request->input('invoice_address.name'),
          'company' => $request->input('invoice_address.company'),
          'street' => $request->input('invoice_address.street'),
          'street_no' => $request->input('invoice_address.street_no'),
          'zip' => $request->input('invoice_address.zip'),
          'city' => $request->input('invoice_address.city'),
          'country_id' => $request->input('invoice_address.country_id'),
          'user_id' => $user->id,
        ] 
      );

      $user->has_invoice_address = TRUE;
      $user->save();
    }

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
