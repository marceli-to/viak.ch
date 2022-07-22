<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\Course;
use App\Models\Event;
use App\Services\Pdf\Pdf;
use App\Services\Pdf\Invoice;
use Illuminate\Http\Request;

class DocumentController extends BaseController
{
  protected $headers = [
    'Content-Type: application/pdf',
    'Cache-Control: no-store, no-cache, must-revalidate',
    'Expires: Sun, 01 Jan 2014 00:00:00 GMT',
    'Pragma: no-cache'
  ];

  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Generate and download a pdf
   * 
   * @return \Illuminate\Http\Response
   */
  public function attendanceConfirmation()
  { 
    $pdf = (new Pdf())->create([
      'data' => '',
      'view' => 'student.course-confirmation',
      'name' => 'kursbestaetigung'
    ]);
    return response()->download($pdf['path'], $pdf['name'], $this->headers);
  }

  /**
   * Generate and download a pdf
   * 
   * @return \Illuminate\Http\Response
   */
  public function courseOverview()
  { 
    $pdf = (new Pdf())->create([
      'data' => '',
      'view' => 'student.course-overview',
      'name' => 'kursuebersicht'
    ]);
    return response()->download($pdf['path'], $pdf['name'], $this->headers);
  }


  /**
   * Generate and download a pdf
   * 
   * @return \Illuminate\Http\Response
   */
  public function participantsList()
  { 
    $pdf = (new Pdf())->create([
      'data' => '',
      'view' => 'course.participants-list',
      'name' => 'teilnehmerliste'
    ]);
    return response()->download($pdf['path'], $pdf['name'], $this->headers);
  }

  /**
   * Generate and download a pdf
   * 
   * @return \Illuminate\Http\Response
   */
  public function invoice()
  { 
    $pdf = (new Invoice())->create([
      'number' => '0000001',
      'amount' => '890.00'
    ]);
    return response()->download($pdf['path'], $pdf['name'], $this->headers);
  }

}
