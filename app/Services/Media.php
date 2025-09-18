<?php
namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class Media
{ 

  /**
   * The temp upload directory.
   */
  protected $temp_directory;

  /**
   * The upload directory.
   */
  protected $upload_directory;

  /**
   * The upload path
   */
  protected $upload_path;

  /**
   * The path for downloads outside the public folder
   */
  protected $download_path = 'files';

  /**
   *  Force lowercase for filenames
   */

  protected $force_lowercase = true;

  /**
   *  Image file types
   */

  protected $image_types = [
    'png', 'jpg', 'jpeg'
  ];
  
  /**
   * Constructor
   */
  public function __construct($opts = array())
  {
    $this->upload_path = storage_path('app/public/temp');
    $this->temp_directory = 'public/temp';
    $this->upload_directory = 'public/uploads';

    if (!File::isDirectory($this->upload_path))
    {
      File::makeDirectory(
        $this->upload_path, 0775, true, true
      );
    }

    if (isset($opts['force_lowercase']))
    {
      $this->force_lowercase = $opts['force_lowercase'];
    }

    if (isset($opts['directory']))
    {
      $this->upload_path = storage_path('app/files/' . $opts['directory']);
    }

  }

  /**
   * Store a file to the storage
   * 
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $file = $request->file('file');
    $name = $this->sanitize(trim($file->getClientOriginalName()), $this->force_lowercase);
    $filename = uniqid()  . '_' . $name;
    $file->move($this->upload_path, $filename);
    $filetype = File::extension($this->upload_path . $filename);
    $filesize = File::size($this->upload_path . DIRECTORY_SEPARATOR . $filename);
    $orientation = null;

    if (in_array(strtolower($filetype), $this->image_types))
    {
      $manager = new ImageManager(new Driver());
      $img = $manager->read($this->upload_path . DIRECTORY_SEPARATOR . $filename);
      $orientation = $img->width() >= $img->height() ? 'l' : 'p';
    }

    return [
      'name' => $filename, 
      'original_name' => $name, 
      'extension' => $filetype, 
      'size' => $filesize,
      'orientation' => $orientation
    ];
  }

  /**
   * Copy a file from temp to storage folder
   * 
   * @param String $filename
   */
  public function copy($filename = NULL)
  {
    return Storage::move(
      $this->temp_directory . DIRECTORY_SEPARATOR . $filename, 
      $this->upload_directory . DIRECTORY_SEPARATOR . $filename
    );
  }

  /**
   * Removes a bunch of files from storage
   * 
   * @param Array $files
   */
  public function removeMany($files = NULL, $temp = FALSE)
  {
    foreach($files as $file)
    {
      if ($temp) {
        return Storage::delete(
          $this->temp_directory . DIRECTORY_SEPARATOR . $file->name
        );
      }
      return Storage::delete(
        $this->upload_directory . DIRECTORY_SEPARATOR . $file->name
      );
    }
  }

  /**
   * Removes a file from storage
   * 
   * @param String $filename
   */
  public function remove($filename = NULL, $temp = FALSE)
  {
    if ($temp)
    {
      return Storage::delete(
        $this->temp_directory . DIRECTORY_SEPARATOR . $filename
      );
    }

    return Storage::delete(
      $this->upload_directory . DIRECTORY_SEPARATOR . $filename
    );
  }

  /**
   * Download a file from outside the public folder
   * 
   * @param String $folder
   * @param String $filename
   */
  public function download($folder = NULL, $filename = NULL)
  {
    return Storage::download(
      $this->download_path . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $filename
    );
  }

  /**
   * Sanitize a filename
   *
   * @param str $filename
   * @param boolean  $force_lowercase - Force the string to lowercase?
   * @param boolean  $anal - If set to *true*, will remove all non-alphanumeric characters.
   */

  protected function sanitize($filename, $force_lowercase = true, $anal = true)
  {
    $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "=", "+", "[", "{", "]", "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;", "â€”", "â€“", ",", "<", ">", "/", "?");
    $clean = trim(str_replace($strip, "", strip_tags($filename)));
    $clean = preg_replace('/\s+/', "-", $clean);
    $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9._\-]/", "", $clean) : $clean ;
    return ($force_lowercase) ? (function_exists('mb_strtolower')) ? mb_strtolower($clean, 'UTF-8') : strtolower($clean) : $clean;
  }

  /**
   * Get the formatted size of a file
   *
   * @param $size
   * @return Number $size
   */

  protected function filesize($size)
  {
    $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $power = $size > 0 ? floor(log($size, 1024)) : 0;
    return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
  }

}
