<?php
namespace App\Services\Pdf;
use PDF as DomPDF;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Pdf
{
  public function __construct()
  {
    // Create storage folder if not already existing
    if (!File::isDirectory(storage_path('app/public/temp')))
    {
      File::makeDirectory(storage_path('app/public/temp'), 0775, true, true);
    }
  }
  
  /**
   * Create a pdf
   * 
   * @return Array
   */

  public function create($opts = array())
  {
    $data = $opts['data'];
    $view = $opts['view'];
    $name = $opts['name'];
    
    $this->viewData['data'] = $data;
    $pdf = DomPDF::loadView('pdf.' . $view, $this->viewData);
    $file = 'viak-'. $name .'-' . date('dmY', time()) . '-' . \Str::random(12) . '.pdf';
    $pdf->save(public_path() . '/storage/temp/' . $file);

    return [
      'path' => public_path() . '/storage/temp/' . $file,
      'name' => $file
    ];
  }
}