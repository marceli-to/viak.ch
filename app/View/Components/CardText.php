<?php
namespace App\View\Components;
use App\Models\Event;
use Illuminate\View\Component;
use App\Stores\BasketStore;

class CardText extends Component
{
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct()
  {
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\View\View|string
   */
  public function render()
  {
    return view('web.components.content.card-text');
  }
}
