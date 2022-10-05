<?php
namespace App\Http\Controllers\Api;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\StudentStoreRequest;
use App\Events\StudentRegistered;
use Illuminate\Http\Request;

class StudentRegisterController extends Controller
{
  use RegistersUsers;
  
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest');
  }

  /**
   * Create a new user
   * 
   * @param StudentStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function create(StudentStoreRequest $request)
  { 
    $user = User::create([
      'firstname' => $request->input('firstname'),
      'name' => $request->input('name'),
      'street' => $request->input('street'),
      'street_no' => $request->input('street_no') ? $request->input('street_no') : NULL,
      'zip' => $request->input('zip'),
      'city' => $request->input('city'),
      'phone' => $request->input('phone') ? $request->input('phone') : NULL,
      // 'has_invoice_address' => $request->input('has_invoice_address'),
      // 'invoice_address' => $request->input('alt_invoice_address'),
      'operating_system' => $request->input('operating_system') ? collect($request->input('operating_system'))->implode(',') : NULL,
      'email' => $request->input('email'),
      'password' => \Hash::make($request->input('password')),
      'uuid' => \Str::uuid(),
      'gender_id' => $request->input('gender_id'),
      'country_id' => $request->input('country_id')
    ]);

    // Attach role
    $user->roles()->attach(Role::STUDENT);

    // Send confirmation email
    event(new StudentRegistered($user));

    // Log the user in
    Auth::login($user);

    return response()->json($user->uuid);
  }

}
