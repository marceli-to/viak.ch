<?php
namespace App\Services;
use Illuminate\Http\Request;
use App\Models\Bookmark as BookmarkModel;
use App\Models\User;
use App\Models\Event;

class Bookmark
{

  /**
   * Store a bookmark
   *
   * @param  Event $event
   * @return \Illuminate\Http\Response
   */
  public function store(Event $event)
  {
    $bookmark = BookmarkModel::create([
      'uuid' => \Str::uuid(),
      'event_id' => $event->id,
      'user_id' => auth()->user()->id,
      'bookmarked_at' => \Carbon\Carbon::now()
    ]);
    $bookmark->save();
    return $bookmark;
  }  

  /**
   * Remove a bookmark
   *
   * @param  Bookmark $bookmark
   * @return Boolean
   */
  public function destroy(Event $event)
  {
    $bookmark = BookmarkModel::where('event_id', $event->id)->where('user_id', auth()->user()->id)->first();
    $bookmark->delete();
    return $bookmark->delete();
  }

  /**
   * Check whether or not a user has a bookmark for a specific event.
   * 
   * @param Event $event
   * @return Boolean
   */

  public function has(Event $event)
  {
    $bookmark = BookmarkModel::where('event_id', $event->id)->where('user_id', auth()->user()->id)->first();
    return $bookmark ? TRUE : FALSE;
  }

}