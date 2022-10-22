<?php
namespace App\Http\Controllers\Api\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\GridRowItem;
use Illuminate\Http\Request;

class GridRowItemController extends Controller
{
  /**
   * Update a grid row item with a news article
   *
   * @param GridRowItem $gridRowItem
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function addNews(GridRowItem $gridRowItem, Request $request)
  {
    $gridRowItem->news_id = $request->input('news_id');
    $gridRowItem->save();
    return response()->json(true);
  }

  /**
   * Update a grid row item with a course teaser
   *
   * @param GridRowItem $gridRowItem
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function addCourse(GridRowItem $gridRowItem, Request $request)
  {
    $gridRowItem->course_id = $request->input('course_id');
    $gridRowItem->save();
    return response()->json(true);
  }

  /**
   * Update a grid row item with a code
   *
   * @param GridRowItem $gridRowItem
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function addCode(GridRowItem $gridRowItem, Request $request)
  {
    $gridRowItem->code = $request->input('code');
    $gridRowItem->save();
    return response()->json(true);
  }

  /**
   * Reset a grid row item
   *
   * @param  GridRow $gridRowItem
   * @return \Illuminate\Http\Response
   */
  public function reset(GridRowItem $gridRowItem)
  {
    $gridRowItem->course_id = NULL;
    $gridRowItem->news_id = NULL;
    $gridRowItem->code = NULL;
    $gridRowItem->save();
    return response()->json('successfully deleted');
  }
}
