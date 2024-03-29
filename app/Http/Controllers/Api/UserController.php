<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Country;
use App\Models\Gender;
use App\Models\Role;
use App\Http\Resources\CountryResource;
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
      'countries' => CountryResource::collection(
        Country::orderBy('order')->get()
      )
    ];

    if (auth()->user() && auth()->user()->isAdmin())
    {
      $data['roles'] = Role::get();
    }

    return response()->json($data);
  }
}
