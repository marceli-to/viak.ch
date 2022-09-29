<?php
namespace App\Services;
use Illuminate\Http\Request;
use App\Models\Bookmark as BookmarkModel;
use App\Models\User;
use App\Models\Event;

class Bookmark
{
  /**
   * Find a bookmark by an event and a user
   * 
   * @param Event $event
   * @param User $user
   * @return \Illuminate\Http\Response
   */

  public function find(Event $event, User $user)
  {
    return BookmarkModel::where('event_id', $event->id)->where('user_id', $user->id)->first();
  }

  /**
   * Find a bookmark by an event and a user and destroy it
   * 
   * @param Event $event
   * @param User $user
   * @return \Illuminate\Http\Response
   */

  public function findAndDestroy(Event $event, User $user)
  {
    return $this->destroy(
      $this->find($event, $user)
    );
  }

  /**
   * Check whether or not a user has a bookmark for a specific event.
   * 
   * @param Event $event
   * @param User $user
   * @return Boolean
   */

  public function has(Event $event, User $user)
  {
    $bookmark = BookmarkModel::where('event_id', $event->id)->where('user_id', $user->id)->first();
    return $bookmark ? TRUE : FALSE;
  }

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
   * @param  BookmarkModel $bookmark
   * @return Boolean
   */
  public function destroy(BookmarkModel $bookmark)
  {
    return $bookmark->delete();
  }

}