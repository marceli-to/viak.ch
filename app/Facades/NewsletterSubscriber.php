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
    return true;
    // if ($user->subscribe_newsletter == 1)
    // {
    //   Newsletter::subscribeOrUpdate($user->email, ['FNAME'=> $user->firstname, 'LNAME'=> $user->name]);
    //   Newsletter::addTags([env('MAILCHIMP_TAGS'), 'Deutsch'], $user->email);
    //   $user->subscribe_newsletter = 1;
    // }
    // else
    // {
    //   Newsletter::unsubscribe($user->email);
    //   $user->subscribe_newsletter = 0;
    // }
    // return $user->save();
  }

}