<?php
namespace App\Facades;
use Illuminate\Http\Request;
use App\Models\User;
use Newsletter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
      try {
        Newsletter::subscribeOrUpdate($user->email, ['FNAME'=> $user->firstname, 'LNAME'=> $user->name]);
        Newsletter::addTags([env('MAILCHIMP_TAGS'), 'Deutsch'], $user->email);
        $user->subscribe_newsletter = 1;
      } catch (\Exception $e) {
        Log::error('Newsletter subscription failed', [
          'user_id' => $user->id,
          'email' => $user->email,
          'error' => $e->getMessage()
        ]);

        // Mail::raw('Newsletter subscription failed for user ' . $user->email . '. Error: ' . $e->getMessage(), function ($message) {
        //   $message->to('m@marceli.to')->subject('Newsletter Subscription Error');
        // });
      }
    }
    else
    {
      try {
        Newsletter::unsubscribe($user->email);
        $user->subscribe_newsletter = 0;
      } catch (\Exception $e) {
        Log::error('Newsletter unsubscription failed', [
          'user_id' => $user->id,
          'email' => $user->email,
          'error' => $e->getMessage()
        ]);

        // Mail::raw('Newsletter unsubscription failed for user ' . $user->email . '. Error: ' . $e->getMessage(), function ($message) {
        //   $message->to('m@marceli.to')->subject('Newsletter Unsubscription Error');
        // });
      }
    }
    return $user->save();
  }

}