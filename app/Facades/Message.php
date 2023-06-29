<?php
namespace App\Facades;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\Message as MessageModel;
use App\Models\Job;
use App\Models\MessageUser;

class Message
{
  public static function past(Event $event, User $user)
  {
    // Get all messages
    $messages = MessageModel::orderBy('created_at')->where('messageable_id', $event->id)->get();

    // Create jobs for all messages
    foreach($messages as $message)
    {
      Job::create([
        'recipient' => $user->email,
        'mailable_id' => $message->id,
        'mailable_type' => \App\Models\Message::class,
        'mailable_class' => \App\Mail\EventMessageStudent::class
      ]);
  
      MessageUser::create([
        'message_id' => $message->id,
        'user_id' => $user->id
      ]);
    }
  }
}