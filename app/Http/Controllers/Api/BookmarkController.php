<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Facades\Bookmark as BookmarkFacade;
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
    $bookmark = BookmarkFacade::store($event);
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
    BookmarkFacade::destroy($bookmark);
    return response()->json('successfully deleted');
  }

}
