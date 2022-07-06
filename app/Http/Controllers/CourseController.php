<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends BaseController
{
  protected $viewPath = 'web.pages.courses.';

  public function courses()
  {
    $courses = Course::with('upcomingEvents.experts', 'categories')->get();
    return view($this->viewPath . 'index', ['courses' => $courses]);
  }

  public function course()
  {
    return view($this->viewPath . 'show');
  }
}
