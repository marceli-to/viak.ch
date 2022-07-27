<?php
namespace App\View\Components;
use Illuminate\View\Component;
use App\Models\Role;

class MenuItemProfile extends Component
{

  /**
   * Set Profile/Dashboard route per users role
   * 
   * @param String $route
   */

  public $route;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($route = NULL)
  {
    $route = 'login';
    if (auth()->user())
    {
      if (auth()->user()->hasMultipleRoles())
      {
        if (session('selected-role'))
        {
          switch(session('selected-role')->key)
          {
            case 'student':
              $route = 'page.student.profile';
            break;
            case 'expert':
              $route = 'page.expert.profile';
            break;
            case 'admin':
              $route = 'page.student.profile';
            break;
          }
        }
      }
      else if (auth()->user()->isStudent())
      {
        $route = 'page.student.profile';
      }
      else if (auth()->user()->isExpert())
      {
        $route = 'page.expert.profile';
      }
      else if (auth()->user()->isAdmin())
      {
        $route = 'page.student.profile';
      }
    }
    $this->route = $route;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\View\View|string
   */
  public function render()
  {
    return view('web.components.menu.profile');
  }
}
