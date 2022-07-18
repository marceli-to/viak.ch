<?php
namespace App\Http\Controllers\Api;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\StudentRegisterRequest;
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
   * @param StudentRegisterRequest $request
   * @return \Illuminate\Http\Response
   */
  public function create(StudentRegisterRequest $request)
  { 
    $user = User::create([
      'firstname' => $request->input('firstname'),
      'name' => $request->input('name'),
      'street' => $request->input('street'),
      'street_no' => $request->input('street_no') ? $request->input('street_no') : NULL,
      'zip' => $request->input('zip'),
      'city' => $request->input('city'),
      'phone' => $request->input('phone') ? $request->input('phone') : NULL,
      'has_invoice_address' => $request->input('has_invoice_address'),
      'invoice_address' => $request->input('alt_invoice_address'),
      'operating_system' => $request->input('os') ? collect($request->input('os'))->implode(', ') : NULL,
      'email' => $request->input('email'),
      'password' => \Hash::make($request->input('password')),
      'uuid' => \Str::uuid(),
      'gender_id' => $request->input('gender')
    ]);

    // Attach role
    $user->roles()->attach(Role::STUDENT);

    // Send confirmation email
    event(new StudentRegistered($user));

    return response()->json($user->uuid);
  }

}
