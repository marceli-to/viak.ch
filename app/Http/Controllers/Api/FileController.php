<?php
namespace App\Http\Controllers\Api;
use App\Models\File;
use App\Models\Fileable;
use App\Services\Media;
use App\Http\Resources\DataCollection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{
  /**
   * Get a list of files
   * 
   * @return \Illuminate\Http\Response
   */
  public function get()
  {
    return new DataCollection(File::orderBy('created_at')->get());
  }

  /**
   * Get a single file for a given file
   * 
   * @param File $file
   * @return \Illuminate\Http\Response
   */
  public function find(File $file)
  {
    $file = File::findOrFail($file->id);
    return response()->json($file);
  }

  /**
   * Store a newly added file
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $data = $request->all();
    $data['uuid'] = \Str::uuid();
    $file = File::create($data);
    return response()->json(['file' => $file]);
  }

  /**
   * Update a file for a given file
   *
   * @param File $file
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function update(File $file, Request $request)
  {
    $file = File::findOrFail($file->id);
    $file->update($request->all());
    return response()->json('successfully updated');
  }

  /**
   * Update the order of the given files
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function order(Request $request)
  {
    $files = $request->get('files');

    foreach($files as $file)
    {
      $i = File::find($file['id']);
      $i->order = $file['order'];
      $i->save(); 
    }
    
    return response()->json('successfully updated');
  }

  /**
   * Toggle the status a given file
   *
   * @param  File $file
   * @return \Illuminate\Http\Response
   */
  public function toggle(File $file)
  {
    $file->publish = $file->publish == 0 ? 1 : 0;
    $file->save();
    return response()->json($file->publish);
  }

  /**
   * Remove the specified file from storage
   *
   * @param  File $file
   * @return \Illuminate\Http\Response
   */
  
  public function destroy(File $file)
  {
    // Remove from fileable relationship
    $fileable_record = Fileable::with('file.messages')->where('file_id', $file->id)->first();
    if ($fileable_record)
    {
      if ($fileable_record->file->messages->count() == 0)
      {
        if ($fileable_record->delete())
        {
          $file_record = File::findOrFail($file->id);
          if ($file_record)
          {
            $file_record->delete();
          }
        }
      }
    }
    
    // Delete from storage
    $directories = Storage::allDirectories('public');
    foreach($directories as $d)
    {
      Storage::delete($d . '/'. $file->name);
    }
    
    return response()->json('successfully deleted');
  }

  /**
   * Upload an file
   * 
   * @param  Request $request
   * @return \Illuminate\Http\Response
   */

  public function upload(Request $request)
  { 
    $media = (new Media(['force_lowercase' => false]))->store($request);
    return response()->json($media);
  }

  /**
   * Delete a file
   * 
   * @param  String $file
   * @return \Illuminate\Http\Response
   */

  public function delete($file)
  { 
    $media = (new Media())->remove($file, TRUE);
    return response()->json($media);
  }
}
