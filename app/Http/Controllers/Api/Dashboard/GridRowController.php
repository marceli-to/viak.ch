<?php
namespace App\Http\Controllers\Api\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Models\GridRow;
use App\Models\GridRowItem;
use App\Http\Requests\GridRowStoreRequest;
use Illuminate\Http\Request;

class GridRowController extends Controller
{

  /**
   * Get a list of grid items
   * 
   * @return \Illuminate\Http\Response
   */
  public function get()
  {
    $items = GridRow::with('items.course.teaserImage', 'items.news.publishedImage', 'items')->orderBy('order')->get();
    return response()->json($items);
  }

  /**
   * Store a grid row and create 2 empty items
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $gridRow = GridRow::create($request->all());

    // Create 2 empty items
    for ($i = 0; $i < 2; $i++)
    {
      GridRowItem::create([
        'course_id' => null,
        'news_id' => null,
        'code' => null,
        'position' => $i, 
        'grid_row_id' => $gridRow->id,
      ]);
    }

    return response()->json($gridRow->with('items'));
  }

  /**
   * Update the order of the given grid rows
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function order(Request $request)
  {
    $items = $request->get('items');
    foreach($items as $item)
    {
      $i = GridRow::find($item['id']);
      $i->order = $item['order'];
      $i->save(); 
    }
    return response()->json('successfully updated');
  }

  /**
   * Remove a grid row with all attached items
   *
   * @param  GridRow $gridRow
   * @return \Illuminate\Http\Response
   */
  public function destroy(GridRow $gridRow)
  {
    foreach($gridRow->items as $item)
    {
      $item->delete();
    }
    $gridRow->delete();
    return response()->json('successfully deleted');
  }
}
