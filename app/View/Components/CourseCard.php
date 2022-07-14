<?php
namespace App\View\Components;
use App\Models\Course;
use Illuminate\View\Component;

class CourseCard extends Component
{

  /**
   * Course
   *
   * @var Course $course
   */
  public $course;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct(Course $course)
  {
    $this->course = $course;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\View\View|string
   */
  public function render()
  {
    return view('web.pages.courses.components.card');
  }
}
