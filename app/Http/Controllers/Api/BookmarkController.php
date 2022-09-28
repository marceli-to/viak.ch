<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Services\Bookmark as BookmarkService;
use App\Models\Bookmark;
use App\Models\Event;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
  /**
   * Store a bookmark
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, Event $event)
  {
    $bookmark = (new BookmarkService())->store($event);
    return response()->json(['uuid' => $bookmark->uuid]);
  }

  /**
   * Remove a bookmark
   *
   * @param  Bookmark $bookmark
   * @return \Illuminate\Http\Response
   */
  public function destroy(Bookmark $bookmark)
  {
    $this->authorize('destroy', $bookmark);
    (new BookmarkService())->destroy($bookmark);
    return response()->json('successfully deleted');
  }

}
