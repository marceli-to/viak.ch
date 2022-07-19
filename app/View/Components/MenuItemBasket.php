<?php
namespace App\View\Components;
use Illuminate\View\Component;
use App\Stores\BasketStore;

class MenuItemBasket extends Component
{
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->count = (new BasketStore())->getItemsCount();
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\View\View|string
   */
  public function render()
  {
    return view('web.components.menu.basket', ['count' => $this->count]);
  }
}
