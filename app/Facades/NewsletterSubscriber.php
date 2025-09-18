<?php
namespace App\Facades;
use Illuminate\Http\Request;
use App\Models\User;
use Newsletter;

class NewsletterSubscriber
{
  
  /**
   * Handle the newsletter subscription of a user
   * 
   * @param User $user
   * @return void
   */

  public static function update(User $user)
  {
    if ($user->subscribe_newsletter == 1)
    {
      Newsletter::subscribeOrUpdate($user->email, ['FNAME'=> $user->firstname, 'LNAME'=> $user->name]);

      $api = Newsletter::getApi();
      $listId = config('newsletter.lists.subscribers.id');
      $memberHash = $api->subscriberHash($user->email);
      $api->patch("lists/{$listId}/members/{$memberHash}/tags", [
        'tags' => [
          ['name' => env('MAILCHIMP_TAGS'), 'status' => 'active'],
          ['name' => 'Deutsch', 'status' => 'active']
        ]
      ]);
      $user->subscribe_newsletter = 1;
    }
    else
    {
      Newsletter::unsubscribe($user->email);
      $user->subscribe_newsletter = 0;
    }
    return $user->save();
  }

}