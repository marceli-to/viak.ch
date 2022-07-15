<?php
namespace App\View\Components;
use App\Models\Course;
use Illuminate\View\Component;

class Collapsible extends Component
{
  /**
   * Title
   *
   * @var String $title
   */
  public $title;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($title = NULL)
  {
    $this->title = $title;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\View\View|string
   */
  public function render()
  {
    return view('web.components.content.collapsible');
  }
}
