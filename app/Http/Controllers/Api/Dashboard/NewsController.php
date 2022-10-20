<?php
namespace App\Http\Controllers\Api\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Models\News;
use App\Http\Requests\NewsStoreRequest;
use Illuminate\Http\Request;

class NewsController extends Controller
{
  
  /**
   * Get a list of news
   * 
   * @return \Illuminate\Http\Response
   */
  public function get()
  {
    return new DataCollection(News::orderBy('created_at', 'DESC')->get());
  }

  /**
   * Get a single news
   * 
   * @param News $news
   * @return \Illuminate\Http\Response
   */
  public function find(News $news)
  {
    $news = News::with('images')->find($news->id);
    return response()->json($news);
  }

  /**
   * Store a newly created news
   *
   * @param  \Illuminate\Http\NewsStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(NewsStoreRequest $request)
  { 
    $news = News::create(
      array_merge(
        $request->all(), 
        [
          'uuid' => \Str::uuid(), 
        ]
      )
    );

    return response()->json(['newsId' => $news->id]);
  }

  /**
   * Update a news for a given news
   *
   * @param News $news
   * @param  \Illuminate\Http\NewsStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function update(News $news, NewsStoreRequest $request)
  {
    $news = News::findOrFail($news->id);
    $news->update($request->all());
    return response()->json('successfully updated');
  }

  /**
   * Toggle the status a given news
   *
   * @param  News $news
   * @return \Illuminate\Http\Response
   */
  public function toggle(News $news)
  {
    $news->publish = $news->publish == 0 ? 1 : 0;
    $news->save();
    return response()->json($news->publish);
  }

  /**
   * Remove a news
   *
   * @param  News $news
   * @return \Illuminate\Http\Response
   */
  public function destroy(News $news)
  {
    $news->delete();
    return response()->json('successfully deleted');
  }
}
