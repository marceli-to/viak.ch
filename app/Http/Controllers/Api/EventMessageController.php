<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Message;
use App\Models\MessageUser;
use App\Models\File;
use App\Models\Fileable;
use App\Models\Job;
use App\Services\Media;
use App\Http\Requests\MessageStoreRequest;
use App\Http\Resources\DataCollection;
use Illuminate\Http\Request;

class EventMessageController extends Controller
{
  /**
   * Get a list of messages
   * 
   * @param Event $event
   * @return \Illuminate\Http\Response
   */
  public function get(Event $event)
  {
    return new DataCollection(
      Message::with('user')->orderBy('date')->where('messageable_id', $event->id)->get()
    );
  }

  /**
   * Find a message by a message
   * 
   * @param Message $message
   * @return \Illuminate\Http\Response
   */
  public function find(Message $message)
  {
    return response()->json(Message::findOrFail($message->id));
  }

  /**
   * Store a newly added message
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(MessageStoreRequest $request)
  {
    // Get the event
    $event = Event::with('bookings')->where('uuid', $request->input('event_uuid'))->first();

    // Create message
    $message = Message::create([
      'subject' => $request->input('subject'),
      'body' => $request->input('body'),
      'user_id' => auth()->user()->id,
      'uuid' => \Str::uuid(),
      'messageable_id' => $event->id,
      'messageable_type' => \App\Models\Event::class,
    ]);

    // Add files to message
    if ($request->input('files'))
    { 
      foreach($request->input('files') as $file)
      {
        $file = File::where('uuid', $file)->get()->first();

        // Attach file to message
        Fileable::create([
          'file_id' => $file->id,
          'fileable_type' => "App\Models\Message",
          'fileable_id' => $message->id
        ]);

        (new Media())->copy($file->name);
      }
    }

    // Create job and add students via a booking
    foreach($event->bookings as $booking)
    {
      Job::create([
        'recipient' => $booking->user->email,
        'mailable_id' => $message->id,
        'mailable_type' => \App\Models\Message::class,
        'mailable_class' => \App\Mail\EventMessageStudent::class
      ]);

      MessageUser::create([
        'message_id' => $message->id,
        'user_id' => $booking->user->id
      ]);
    }

    // Create additional job for the current user if selfcopy is required
    if ($request->input('selfcopy'))
    {
      Job::create([
        'recipient' => auth()->user()->email,
        'mailable_id' => $message->id,
        'mailable_type' => \App\Models\Message::class,
        'mailable_class' => \App\Mail\EventMessageExpert::class
      ]);
    }
   
    return response()->json(['uuid' => $message->uuid]);
  }
}
