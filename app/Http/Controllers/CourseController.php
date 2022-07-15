<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\Course;
use App\Services\CourseFilter;
use Illuminate\Http\Request;

class CourseController extends BaseController
{
  protected $viewPath = 'web.pages.courses.';

  /**
   * Constructor
   */

  public function __construct()
  {

  }

  /**
   * Show a list of courses
   * 
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
   
  public function list(Request $request)
  {
    $data = (new CourseFilter())->apply(null, true);
    return view($this->viewPath . 'list', ['courses' => $data['courses']]);
  }

  /**
   * Show a course.
   * 
   * @param  Course $course
   * @return \Illuminate\Http\Response
   */

  public function show($slug = NULL, Course $course)
  {
    $course = Course::with('upcomingEvents.experts', 'upcomingEvents.dates', 'upcomingEvents.location', 'categories')->find($course->id);
    return view($this->viewPath . 'show', ['course' =>  $course ]);
  }
}
