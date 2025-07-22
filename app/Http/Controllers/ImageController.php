<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use Intervention\Image\ImageManager;
use Illuminate\Http\Request;
use MarceliTo\ImageCache\Facades\ImageCache;
use Illuminate\Support\Facades\File;
use Config;

class ImageController extends Controller
{
  protected $maxSize;
  protected $coords;
  protected $ratio;
  
  /**
   * Get HTTP response of either original image file or
   * template applied file.
   *
   * @param  string $template
   * @param  string $filename
   * @return Illuminate\Http\Response
   */

  public function getResponse($template, $filename, $maxSize = NULL, $coords = NULL, $ratio = FALSE)
  {
    $this->maxSize  = $maxSize;
    $this->coords   = $coords;
    $this->ratio    = $ratio;

    switch (strtolower($template)) {
      case 'original':
        return $this->getOriginal($filename);

      case 'download':
        return $this->getDownload($filename);

      default:
        return $this->getImage($template, $filename);
    }
  }

  /**
   * Returns corresponding template object from given template name
   *
   * @param  string $template
   * @return mixed
   */
  protected function getTemplate($template)
  {
    $template = config("imagecache.templates.{$template}");

    switch (true) {
    // closure template found
    case is_callable($template):
      return $template;

    // filter template found
    case class_exists($template):
      return new $template($this->maxSize, $this->coords, $this->ratio);

    default:
      // template not found
      abort(404);
      break;
    }
  }

  /**
   * Get original image
   */
  protected function getOriginal($filename)
  {
    try {
      $paths = config('imagecache.paths', []);
      foreach ($paths as $path) {
        $filePath = $path . '/' . $filename;
        if (File::exists($filePath)) {
          return response()->file($filePath);
        }
      }
      abort(404, 'Image not found');
    } catch (\Exception $e) {
      abort(500, 'Error serving image');
    }
  }

  /**
   * Get download response
   */
  protected function getDownload($filename)
  {
    try {
      $paths = config('imagecache.paths', []);
      foreach ($paths as $path) {
        $filePath = $path . '/' . $filename;
        if (File::exists($filePath)) {
          return response()->download($filePath);
        }
      }
      abort(404, 'Image not found');
    } catch (\Exception $e) {
      abort(500, 'Error serving image download');
    }
  }

  /**
   * Get processed image
   */
  protected function getImage($template, $filename)
  {
    try {
      $params = [];
      
      if ($this->maxSize) {
        $params['maxSize'] = $this->maxSize;
      }
      if ($this->coords) {
        $params['coords'] = $this->coords;
      }
      if ($this->ratio) {
        $params['ratio'] = $this->ratio;
      }
      
      $cachedImagePath = ImageCache::getCachedImage($template, $filename, $params);
      
      if (!$cachedImagePath) {
        abort(404, 'Image not found');
      }
      
      return response()->file($cachedImagePath);
    } catch (\InvalidArgumentException $e) {
      abort(400, $e->getMessage());
    } catch (\Exception $e) {
      abort(500, 'Error processing image');
    }
  }
}
