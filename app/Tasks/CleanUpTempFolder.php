<?php
namespace App\Tasks;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CleanUpTempFolder
{
  public function __invoke()
  {
    $files = \Storage::listContents('public/temp');
    collect($files)->each(function($file) {
      if ($file->lastModified() < now()->subMinutes(120)->getTimestamp())
      {
        \Storage::delete($file->path());
      }
    });
  }
}