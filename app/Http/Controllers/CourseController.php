<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends BaseController
{
  protected $viewPath = 'web.pages.courses.';

  /**
   * Show a list of courses
   * @return \Illuminate\Http\Response
   */
   
  public function list()
  {
    $courses = Course::with('upcomingEvents.experts', 'categories')->get();
    return view($this->viewPath . 'list', ['courses' => $courses]);
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
