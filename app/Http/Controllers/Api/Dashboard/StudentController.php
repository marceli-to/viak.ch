<?php
namespace App\Http\Controllers\Api\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Models\User;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use Illuminate\Http\Request;

class StudentController extends Controller
{
  /**
   * Get a list of users
   * 
   * @param String $constraint
   * @return \Illuminate\Http\Response
   */
  public function get($constraint = NULL)
  {
    if ($constraint == 'publish')
    {
      return new DataCollection(User::published()->orderBy('name', 'ASC')->get());
    }
    return new DataCollection(User::students()->orderBy('name', 'ASC')->get());
  }

  /**
   * Get a single user
   * 
   * @param User $user
   * @return \Illuminate\Http\Response
   */
  public function find(User $user)
  {
    $user = User::find($user->id);
    return response()->json($user);
  }

  /**
   * Store a newly created user
   *
   * @param  \Illuminate\Http\StudentStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(StudentStoreRequest $request)
  {
    $user = User::create($request->all());
    return response()->json(['userId' => $user->id]);
  }

  /**
   * Update a user for a given user
   *
   * @param User $user
   * @param  \Illuminate\Http\StudentUpdateRequest $request
   * @return \Illuminate\Http\Response
   */
  public function update(User $user, StudentUpdateRequest $request)
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
