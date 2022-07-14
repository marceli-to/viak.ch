<?php
namespace App\View\Components;
use App\Models\User;
use Illuminate\View\Component;

class ExpertCard extends Component
{

  /**
   * User
   *
   * @var User $user
   */

  public $user;

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
    $this->user = $user;
    $this->courses = collect($user->events()->with('course')->get()->pluck('course.title')->unique());
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
