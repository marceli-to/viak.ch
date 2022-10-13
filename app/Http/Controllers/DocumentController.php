<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\Course;
use App\Models\Event;
use App\Services\Pdf\Pdf;
use App\Services\Pdf\Invoice\EventInvoice;
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

  public function index()
  {
    return view('web.pages.test.index');
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
   * @param Event $event
   * @return \Illuminate\Http\Response
   */
  public function participantsList(Event $event)
  { 
    $event = $event->with('course', 'experts')->findOrFail($event->id);
    $pdf = (new Pdf())->create([
      'data' => [
        'event' => $event,
        'students' => $event->getStudents()
      ],
      'view' => 'course.participants-list',
      'name' => 'teilnehmerliste',
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
    
    $pdf = (new EventInvoice())->create([
      'number' => '0000001',
      'amount' => '890.00'
    ]);
    return response()->download($pdf['path'], $pdf['name'], $this->headers);
  }

}
