<?php
namespace App\View\Components;
use App\Models\User;
use Illuminate\View\Component;

class ExpertCard extends Component
{

  /**
   * Expert
   *
   * @var User $user
   */

  public $expert;

  /**
   * Courses
   *
   * @var Array $courses
   */

  public $courses;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct(User $user)
  {
    $this->expert = $user;
    $this->courses = collect($this->expert->getCourses($user)->pluck('course.title')->unique());
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\View\View|string
   */
  public function render()
  {
    return view('web.pages.experts.components.card');
  }
}
