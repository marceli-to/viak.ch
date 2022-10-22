<?php
namespace App\Http\Controllers\Api\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Models\Hero;
use App\Http\Requests\HeroStoreRequest;
use Illuminate\Http\Request;

class HeroController extends Controller
{
  
  /**
   * Get a list of hero
   * 
   * @return \Illuminate\Http\Response
   */
  public function get()
  {
    return new DataCollection(Hero::with('images')->orderBy('slug', 'DESC')->get());
  }

  /**
   * Get a single hero
   * 
   * @param Hero $hero
   * @return \Illuminate\Http\Response
   */
  public function find(Hero $hero)
  {
    $hero = Hero::with('images')->find($hero->id);
    return response()->json($hero);
  }

  /**
   * Store a newly created hero
   *
   * @param  \Illuminate\Http\HeroStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(HeroStoreRequest $request)
  { 
    $hero = Hero::create(
      array_merge(
        $request->all(), 
        [
          'uuid' => \Str::uuid(),
          'slug' => \Str::slug($request->input('title')) 
        ]
      )
    );

    return response()->json(['heroId' => $hero->id]);
  }

  /**
   * Update a hero for a given hero
   *
   * @param Hero $hero
   * @param  \Illuminate\Http\HeroStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function update(Hero $hero, HeroStoreRequest $request)
  {
    $hero = Hero::findOrFail($hero->id);
    $hero->update($request->all());
    $hero->save();
    return response()->json('successfully updated');
  }

  /**
   * Toggle the status a given hero
   *
   * @param  Hero $hero
   * @return \Illuminate\Http\Response
   */
  public function toggle(Hero $hero)
  {
    $hero->publish = $hero->publish == 0 ? 1 : 0;
    $hero->save();
    return response()->json($hero->publish);
  }

  /**
   * Remove a hero
   *
   * @param  Hero $hero
   * @return \Illuminate\Http\Response
   */
  public function destroy(Hero $hero)
  {
    $hero->delete();
    return response()->json('successfully deleted');
  }
}
