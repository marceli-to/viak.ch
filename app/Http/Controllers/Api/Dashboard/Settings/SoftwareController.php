<?php
namespace App\Http\Controllers\Api\Dashboard\Settings;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Models\Software;
use App\Http\Requests\SoftwareStoreRequest;
use Illuminate\Http\Request;

class SoftwareController extends Controller
{
  /**
   * Get categories
   * 
   * 
   * @return \Illuminate\Http\Response
   */
  public function get()
  {
    return new DataCollection(Software::get());
  }

  /**
   * Get a single software
   * 
   * @param Software $software
   * @return \Illuminate\Http\Response
   */
  public function find(Software $software)
  {
    $software = Software::find($software->id);
    return response()->json($software);
  }

  /**
   * Store a newly created software
   *
   * @param  \Illuminate\Http\SoftwareStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(SoftwareStoreRequest $request)
  {
    $software = Software::create(
      array_merge(
        $request->all(), 
        ['uuid' => \Str::uuid()]
      )
    );
    return response()->json(['softwareId' => $software->id]);
  }

  /**
   * Update a software for a given software
   *
   * @param Software $software
   * @param  \Illuminate\Http\SoftwareStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function update(Software $software, SoftwareStoreRequest $request)
  {
    $software->update($request->all());
    return response()->json('successfully updated');
  }

  /**
   * Remove a software
   *
   * @param  Software $software
   * @return \Illuminate\Http\Response
   */
  public function destroy(Software $software)
  {
    $software->delete();
    return response()->json('successfully deleted');
  }

}
