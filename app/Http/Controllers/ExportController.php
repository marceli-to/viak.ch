<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CoursesExport;
use Illuminate\Http\Request;

class ExportController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  { 
    $timestamp = date('d.m.Y', time());
    return Excel::download(new CoursesExport, 'viak-kurse-'.$timestamp.'-'.\Str::random(8).'.xlsx');
  }

}
