<?php
namespace App\Http\Controllers\Api\Dashboard\Settings;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Models\Location;
use App\Http\Requests\LocationStoreRequest;
use Illuminate\Http\Request;

class LocationController extends Controller
{
  /**
   * Get categories
   * 
   * 
   * @return \Illuminate\Http\Response
   */
  public function get()
  {
    return new DataCollection(Location::get());
  }

  /**
   * Get a single location
   * 
   * @param Location $location
   * @return \Illuminate\Http\Response
   */
  public function find(Location $location)
  {
    $location = Location::find($location->id);
    return response()->json($location);
  }

  /**
   * Store a newly created location
   *
   * @param  \Illuminate\Http\LocationStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(LocationStoreRequest $request)
  {
    $location = Location::create(
      array_merge(
        $request->all(), 
        ['uuid' => \Str::uuid()]
      )
    );
    return response()->json(['locationId' => $location->id]);
  }

  /**
   * Update a location for a given location
   *
   * @param Location $location
   * @param  \Illuminate\Http\LocationStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function update(Location $location, LocationStoreRequest $request)
  {
    $location->update($request->all());
    return response()->json('successfully updated');
  }

  /**
   * Remove a location
   *
   * @param  Location $location
   * @return \Illuminate\Http\Response
   */
  public function destroy(Location $location)
  {
    $location->delete();
    return response()->json('successfully deleted');
  }

}
