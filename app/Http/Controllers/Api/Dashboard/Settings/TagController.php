<?php
namespace App\Http\Controllers\Api\Dashboard\Settings;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Models\Tag;
use App\Http\Requests\TagStoreRequest;
use Illuminate\Http\Request;

class TagController extends Controller
{
  /**
   * Get categories
   * 
   * 
   * @return \Illuminate\Http\Response
   */
  public function get()
  {
    return new DataCollection(Tag::get());
  }

  /**
   * Get a single tag
   * 
   * @param Tag $tag
   * @return \Illuminate\Http\Response
   */
  public function find(Tag $tag)
  {
    $tag = Tag::find($tag->id);
    return response()->json($tag);
  }

  /**
   * Store a newly created tag
   *
   * @param  \Illuminate\Http\TagStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(TagStoreRequest $request)
  {
    $tag = Tag::create(
      array_merge(
        $request->all(), 
        ['uuid' => \Str::uuid()]
      )
    );
    return response()->json(['tagId' => $tag->id]);
  }

  /**
   * Update a tag for a given tag
   *
   * @param Tag $tag
   * @param  \Illuminate\Http\TagStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function update(Tag $tag, TagStoreRequest $request)
  {
    $tag = Tag::findOrFail($tag->id);
    $tag->update($request->all());
    return response()->json('successfully updated');
  }

  /**
   * Remove a tag
   *
   * @param  Tag $tag
   * @return \Illuminate\Http\Response
   */
  public function destroy(Tag $tag)
  {
    $tag->delete();
    return response()->json('successfully deleted');
  }

}
