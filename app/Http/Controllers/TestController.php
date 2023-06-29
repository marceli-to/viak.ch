<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\Job;
use App\Models\Event;
use App\Models\Course;
use App\Models\User;
use App\Models\UserDocument;
use App\Models\Booking;
use App\Models\Message;
use App\Models\Country;
use App\Services\Pdf\EventParticipationConfirmation;
use App\Http\Resources\EventParticipantsResource;
use App\Events\BookingCompleted;
use Newsletter;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CoursesExport;
use Illuminate\Http\Request;

class TestController extends BaseController
{
  protected $viewPath = 'web.pages.';

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  { 
    $timestamp = date('d.m.Y', time());
    dd($timestamp);
    return Excel::download(new CoursesExport, 'viak-kurse-'.$timestamp.'-'.\Str::random(8).'.xlsx');
    // Get a courses with pastEvents
    // $courses = Course::with('pastEvents.bookings.user')->get();
    // dd($courses[0]->pastEvents[0]);
  }

}
