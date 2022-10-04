<?php
namespace App\Http\Controllers\Api;
use App\Models\File;
use App\Models\Fileable;
use App\Models\Event;
use App\Services\Media;
use App\Http\Controllers\Api\FileController;
use Illuminate\Http\Request;

class EventFileController extends FileController
{
  /**
   * Store a newly added file
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    if ($request->input('files'))
    { 
      $event = Event::where('uuid', $request->input('event_uuid'))->first();

      foreach($request->input('files') as $file)
      {
        $file = File::where('uuid', $file)->get()->first();

        // Attach file to event
        Fileable::create([
          'file_id' => $file->id,
          'fileable_type' => "App\Models\Event",
          'fileable_id' => $event->id
        ]);

        (new Media())->copy($file->name);
      }
    }

    return response()->json(['successfully stored']);
  }

}
