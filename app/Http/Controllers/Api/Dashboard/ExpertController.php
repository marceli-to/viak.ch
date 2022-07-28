<?php
namespace App\Http\Controllers\Api\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use App\Http\Requests\ExpertStoreRequest;
use App\Http\Requests\ExpertUpdateRequest;
use Illuminate\Http\Request;

class ExpertController extends Controller
{
  /**
   * Get a list of users
   * 
   * @param String $constraint
   * @return \Illuminate\Http\Response
   */
  public function get()
  {
    return response()->json([
      'active' =>  User::experts()->published()->orderBy('name', 'ASC')->get(),
      'inactive' =>  User::experts()->unpublished()->orderBy('name', 'ASC')->get(),
    ]);
  }

  /**
   * Get a single user
   * 
   * @param User $user
   * @return \Illuminate\Http\Response
   */
  public function find(User $user)
  {
    $user = User::with('images')->find($user->id);
    return response()->json($user);
  }

  /**
   * Store a newly created user
   *
   * @param  \Illuminate\Http\ExpertStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(ExpertStoreRequest $request)
  { 
    // Create password
    $password = \Str::random(16);

    // Create 'expert' and attach role
    $user = User::create(
      array_merge(
        $request->all(), 
        ['uuid' => \Str::uuid(), 'password' => \Hash::make($password)]
      )
    );
    $user->roles()->attach(Role::EXPERT);
    $user->save();

    return response()->json(['userId' => $user->id]);
  }

  /**
   * Update a user for a given user
   *
   * @param User $user
   * @param  \Illuminate\Http\ExpertUpdateRequest $request
   * @return \Illuminate\Http\Response
   */
  public function update(User $user, ExpertUpdateRequest $request)
  {
    $user = User::findOrFail($user->id);
    $user->update($request->all());
    return response()->json('successfully updated');
  }

  /**
   * Toggle the status a given user
   *
   * @param  User $user
   * @return \Illuminate\Http\Response
   */
  public function toggle(User $user)
  {
    $user->publish = $user->publish == 0 ? 1 : 0;
    $user->save();
    return response()->json($user->publish);
  }

  /**
   * Remove a user
   *
   * @param  User $user
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
    $user->delete();
    return response()->json('successfully deleted');
  }
}
