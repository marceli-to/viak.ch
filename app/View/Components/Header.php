<?php
namespace App\View\Components;
use Illuminate\View\Component;

class Header extends Component
{
  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\View\View|string
   */
  public function render()
  {
    return view('web.components.header');
  }
}
