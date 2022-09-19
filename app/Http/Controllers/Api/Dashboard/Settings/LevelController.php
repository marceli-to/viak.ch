<?php
namespace App\Http\Controllers\Api\Dashboard\Settings;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Models\Level;
use App\Http\Requests\LevelStoreRequest;
use Illuminate\Http\Request;

class LevelController extends Controller
{
  /**
   * Get categories
   * 
   * 
   * @return \Illuminate\Http\Response
   */
  public function get()
  {
    return new DataCollection(Level::get());
  }

  /**
   * Get a single level
   * 
   * @param Level $level
   * @return \Illuminate\Http\Response
   */
  public function find(Level $level)
  {
    $level = Level::find($level->id);
    return response()->json($level);
  }

  /**
   * Store a newly created level
   *
   * @param  \Illuminate\Http\LevelStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(LevelStoreRequest $request)
  {
    $level = Level::create($request->all());
    $level->save();
    return response()->json(['levelId' => $level->id]);
  }

  /**
   * Update a level for a given level
   *
   * @param Level $level
   * @param  \Illuminate\Http\LevelStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function update(Level $level, LevelStoreRequest $request)
  {
    $level = Level::findOrFail($level->id);
    $level->update($request->all());
    return response()->json('successfully updated');
  }

  /**
   * Remove a level
   *
   * @param  Level $level
   * @return \Illuminate\Http\Response
   */
  public function destroy(Level $level)
  {
    $level->delete();
    return response()->json('successfully deleted');
  }

}
