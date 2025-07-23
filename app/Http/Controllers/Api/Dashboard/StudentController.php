<?php
namespace App\Http\Controllers\Api\Dashboard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Http\Resources\StudentResource;
use App\Http\Resources\StudentDocumentResource;
use App\Models\User;
use App\Models\Role;
use App\Facades\NewsletterSubscriber;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Events\StudentRegistered;

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
      return new DataCollection(User::students()->published()->orderBy('name', 'ASC')->get());
    }
    return new DataCollection(User::students()->orderBy('name', 'ASC')->get());
  }

  /**
   * Get a list of users by a keyword
   * 
   * @param String $constraint
   * @return \Illuminate\Http\Response
   */
  public function search($keyword = NULL)
  {
    return new DataCollection(
      User::students()->whereLike('firstname', $keyword)->orWhereLike('name', $keyword)->published()->orderBy('name', 'ASC')->get()
    );
  }

  /**
   * Get a single user
   * 
   * @param User $user
   * @return \Illuminate\Http\Response
   */
  public function find(User $user)
  {
    $data = StudentResource::make(
      User::with('bookings', 'invoiceAddresses')->findOrFail($user->id)
    )->withAllData(true);
    return response()->json($data);
  }

  /**
   * Get a student with:
   * 
   * - Documents
   * @param User $user
   * @return \Illuminate\Http\Response
   */
  public function getDocuments(User $user)
  { 
    $user = User::findOrFail($user->id);
    return response()->json(StudentDocumentResource::collection($user->documents()->get()));
  }


  /**
   * Store a newly created user
   *
   * @param  \Illuminate\Http\StudentStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(StudentStoreRequest $request)
  {
    $user = User::create([
      'firstname' => $request->input('firstname'),
      'name' => $request->input('name'),
      'company' => $request->input('company'),
      'street' => $request->input('street'),
      'street_no' => $request->input('street_no') ? $request->input('street_no') : NULL,
      'zip' => $request->input('zip'),
      'city' => $request->input('city'),
      'phone' => $request->input('phone') ? $request->input('phone') : NULL,
      'operating_system' => $request->input('operating_system') ? collect($request->input('operating_system'))->implode(',') : NULL,
      'subscribe_newsletter' => $request->input('subscribe_newsletter'),
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

    // Add user to Mailchimp List
    if (app()->environment('production'))
    {
      NewsletterSubscriber::update($user);
    }

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

    // Handle newsletter subscription
    NewsletterSubscriber::update($user);

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
    if ($user->hasMultipleRoles())
    {
      $user->roles()->detach(Role::STUDENT);
      return response()->json('successfully removed role');
    }

    $user->delete();
    return response()->json('successfully deleted');
  }
}
