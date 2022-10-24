<?php
namespace App\View\Components;
use App\Models\GridRowItem;
use Illuminate\View\Component;

class CodeCard extends Component
{
  /**
   * GridRowItem $item
   *
   * @var GridRowItem $item
   */

  public $item;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($item = NULL)
  {
    $this->item = $item;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\View\View|string
   */
  public function render()
  {
    return view('web.components.content.card-code');
  }
}
