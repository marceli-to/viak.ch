<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExpertResource;
// use App\Http\Resources\ExpertEventResource;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Requests\ExpertUpdateRequest;

class ExpertController extends Controller
{
  /**
   * Find an expert by the authenticated user
   * 
   * @return \Illuminate\Http\Response
   */
  public function find()
  { 
    $data = new ExpertResource(User::findOrFail(auth()->user()->id));
    return response()->json($data);
  }

  /**
   * Update an exper
   * 
   * @param ExpertUpdateRequest $request
   * @return \Illuminate\Http\Response
   */
  public function update(ExpertUpdateRequest $request)
  { 
    $user = User::findOrFail(auth()->user()->id);
    $user->update($request->except([
      'new_email', 'new_password'
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
