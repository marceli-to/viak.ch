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

    $api = Newsletter::getApi();
    $listId = config('newsletter.lists.subscribers.id');
    $memberHash = $api->subscriberHash($request->input('email'));
    $api->patch("lists/{$listId}/members/{$memberHash}/tags", [
      'tags' => [
        ['name' => env('MAILCHIMP_TAGS'), 'status' => 'active'],
        ['name' => 'Deutsch', 'status' => 'active']
      ]
    ]);

    return response()->json(200);
  }

}
