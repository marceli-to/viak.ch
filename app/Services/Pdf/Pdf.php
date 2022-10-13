<?php
namespace App\Services\Pdf;
use PDF as DomPDF;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Pdf
{
  protected $storageFolder;

  public function __construct()
  {
    $this->storageFolder = public_path() . '/storage/files/';

    if (!File::isDirectory(storage_path('app/public/files')))
    {
      File::makeDirectory(storage_path('app/public/files'), 0775, true, true);
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
    $output = isset($opts['output']) ? $opts['output'] : NULL;
    
    $this->viewData['data'] = $data;
    $pdf = DomPDF::loadView('pdf.' . $view, $this->viewData);
    $file = 'viak-'. $name .'-' . date('dmY', time()) . '-' . \Str::random(12) . '.pdf';
    $pdf->save($this->storageFolder . $file);

    if ($output == 'stream')
    {
      return $pdf->stream();
    }

    return [
      'path' => $this->storageFolder . $file,
      'name' => $file
    ];
  }
}