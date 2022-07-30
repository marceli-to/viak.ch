<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\ExpertStorePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ConfirmExpertController extends Controller
{
  protected $viewPath = 'auth.';

  /**
   * Show the set password form
   * @return \Illuminate\Http\Response
   */

  public function confirm($token)
  {
    $user = User::where('confirm_token', $token)->first();
    return view($this->viewPath . 'confirm', ['uuid' => $user->uuid]);
  }

  /**
   * Update a user
   * 
   * @param ExpertStorePasswordRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(ExpertStorePasswordRequest $request)
  { 
    $user = User::where('uuid', $request->input('uuid'))->first();
    $user->email_verified_at = \Carbon\Carbon::now();
    $user->password = \Hash::make($request->input('password'));
    $user->confirm_token = NULL;
    $user->save();
    return view($this->viewPath . 'confirm', ['isConfirmed' => TRUE]);
  }

}
