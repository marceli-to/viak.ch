<?php
namespace App\View\Components;
use Illuminate\View\Component;
use App\Models\Role;

class MenuItemProfile extends Component
{

  /**
   * Route per users role
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
    if (auth()->user())
    {
      if (auth()->user()->hasMultipleRoles())
      {
        if (session('user-selected-role'))
        {
          switch(session('user-selected-role')->key)
          {
            case 'student':
              $route = 'page.student.profile';
            break;
            case 'expert':
              $route = 'page.student.profile';
            break;
            case 'student':
              $route = 'page.student.profile';
            break;
          }
        }
      }
      else if (auth()->user()->hasRole(Role::find(Role::STUDENT)))
      {
        $route = 'page.student.profile';
      }
      else if (auth()->user()->hasRole(Role::find(Role::EXPERT)))
      {
        $route = 'page.student.profile';
      }
      else if (auth()->user()->hasRole(Role::find(Role::ADMIN)))
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
