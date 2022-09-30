<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Message;
use App\Http\Resources\DataCollection;
use Illuminate\Http\Request;

class MessageController extends Controller
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
}
