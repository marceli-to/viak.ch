<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\NewsletterSubscriberRequest;
use Newsletter;

class NewsletterSubscriberController extends Controller
{
  /**
   * Subscribe a user to the newsletter
   * 
   * @param NewsletterSubscriberRequest $request
   * @return \Illuminate\Http\Response
   */
  public function subscribe(NewsletterSubscriberRequest $request)
  {
    Newsletter::subscribeOrUpdate(
      $request->input('email'),
      [
        'FNAME'=> $request->input('firstname'),
        'LNAME'=> $request->input('name')
      ]
    );
    Newsletter::addTags([env('MAILCHIMP_TAGS')], $request->input('email'));
    return response()->json(200);
  }

}
