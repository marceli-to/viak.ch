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
    $data = (new CourseFilter())->apply($request, true);
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
    $course = Course::with(
      'upcomingEvents.experts', 
      'upcomingEvents.dates', 
      'upcomingEvents.location', 
      'categories',
      'publishedVideos'
    )->find($course->id);
    return view($this->viewPath . 'show', ['course' =>  $course, 'browse' => $this->getBrowse($course)]);
  }

  /**
   * Get the previous and the next course in the
   * filtered list of courses.
   * 
   * @param  Course $course
   * @return \Illuminate\Http\Response
   */

  protected function getBrowse(Course $course)
  {
    $data = (new CourseFilter())->apply(null, true);
    
    if (collect($data['courses'])->count() <= 1)
    {
      return NULL;
    }
    $keys = [];
    foreach($data['courses'] as $c)
    {
      $keys[] = $c['uuid'];
    }
    // Get current key
    $key = array_search($course->uuid, $keys);

    if ($key == 0)
    {
      $prevUuid = end($keys);
      $nextUuid = isset($keys[$key+1]) ? $keys[$key+1] : NULL;
    }
    else if ($key == count($keys) - 1)
    {
      $prevUuid = $keys[$key-1];
      $nextUuid = $keys[0];
    }
    else
    {
      $prevUuid = $keys[$key-1];
      $nextUuid = $keys[$key+1];
    }

    $items = [
      'prev' => Course::where('uuid', $prevUuid)->first(),
      'next' => Course::where('uuid', $nextUuid)->first()
    ];
    return $items;
  }

}
