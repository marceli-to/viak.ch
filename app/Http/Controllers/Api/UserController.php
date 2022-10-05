<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Country;
use App\Models\Gender;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UserController extends Controller
{
  /**
   * Get users info by authenticated user
   */
  
  public function find()
  {
    $user = User::findOrFail(auth()->user()->id);
    $data = [
      'firstname' => $user->firstname, 
      'name' => $user->name,
      'full_name' => $user->full_name, 
      'email' => $user->email,
    ];
   
    return response()->json($data);
  }

  /**
   * Get user settings (Genders, Countries)
   */
  
  public function settings()
  {
    $data = [
      'genders' => Gender::get(),
      'countries' => Country::orderBy('order')->get(),
    ];
    return response()->json($data);
  }
}
