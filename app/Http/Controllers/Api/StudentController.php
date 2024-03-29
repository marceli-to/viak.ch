<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Http\Resources\StudentDocumentResource;
use App\Models\User;
use App\Models\UserAddress;
use App\Facades\NewsletterSubscriber;
use Illuminate\Http\Request;
use App\Http\Requests\StudentUpdateRequest;

class StudentController extends Controller
{
  /**
   * Get a student with:
   * 
   * - Bookings
   * - Bookmarks
   * 
   * @return \Illuminate\Http\Response
   */
  public function find()
  { 
    $data = StudentResource::make(
      User::with('invoiceAddresses')->findOrFail(auth()->user()->id)
    );
    return response()->json($data);
  }

/**
   * Get a students profile info with:
   * 
   * - Bookings
   * - Bookmarks
   * - Documents
   * 
   * @return \Illuminate\Http\Response
   */
  public function profile()
  { 
    $data = StudentResource::make(
      User::with('invoiceAddresses')->findOrFail(auth()->user()->id)
    )->withAllData(true);
    return response()->json($data);
  }


  /**
   * Get a student with:
   * 
   * - Documents
   * 
   * @return \Illuminate\Http\Response
   */
  public function getDocuments()
  { 
    $user = User::findOrFail(auth()->user()->id);
    return response()->json(StudentDocumentResource::collection($user->documents()->get()));
  }


  /**
   * Update a student
   * 
   * @param StudentUpdateRequest $request
   * @return \Illuminate\Http\Response
   */
  public function update(StudentUpdateRequest $request)
  { 
    $user = User::findOrFail(auth()->user()->id);

    // Update user data (without password)
    $user->update($request->except([
      'email', 'password', 'operating_system'
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

    // Handle newsletter subscription
    NewsletterSubscriber::update($user);

    return response()->json($user->uuid);
  }

}
