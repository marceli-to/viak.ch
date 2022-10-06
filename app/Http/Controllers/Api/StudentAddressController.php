<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Http\Requests\StudentAddressUpdateRequest;

class StudentAddressController extends Controller
{
  /**
   * Update a student
   * 
   * @param StudentUpdateRequest $request
   * @return \Illuminate\Http\Response
   */
  public function update(StudentAddressUpdateRequest $request)
  { 
    $user = User::findOrFail(auth()->user()->id);
    $user->has_invoice_address = 1;
    $user->save();

    $uuid = $request->input('invoice_address.uuid') ? $request->input('invoice_address.uuid') : \Str::uuid();
    $address = UserAddress::updateOrCreate(
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
        'user_id' => $user->id
      ] 
    );

    return response()->json($address->uuid);
  }

}
