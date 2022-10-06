<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Http\Requests\StudentAddressRequest;

class StudentAddressController extends Controller
{
  /**
   * Get a single userAddress
   * 
   * @param UserAddress $userAddress
   * @return \Illuminate\Http\Response
   */
  public function find(UserAddress $userAddress)
  {
    $userAddress = UserAddress::find($userAddress->id);
    return response()->json($userAddress);
  }

  /**
   * Store a newly created userAddress
   *
   * @param  \Illuminate\Http\StudentAddressRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(StudentAddressRequest $request)
  {
    $userAddress = UserAddress::create(
      array_merge(
        $request->all(), 
        [
          'uuid' => \Str::uuid(),
          'user_id' => auth()->user()->id,
        ]
      )
    );
    return response()->json(['userAddress' => $userAddress->uuid]);
  }

  /**
   * Update a userAddress for a given userAddress
   *
   * @param UserAddress $userAddress
   * @param  \Illuminate\Http\StudentAddressRequest $request
   * @return \Illuminate\Http\Response
   */
  public function update(UserAddress $userAddress, StudentAddressRequest $request)
  {
    $userAddress = UserAddress::findOrFail($userAddress->id);
    $userAddress->update($request->all());
    return response()->json('successfully updated');
  }

  /**
   * Remove a userAddress
   *
   * @param  UserAddress $userAddress
   * @return \Illuminate\Http\Response
   */
  public function destroy(UserAddress $userAddress)
  {
    $userAddress->delete();
    return response()->json('successfully deleted');
  }
}
