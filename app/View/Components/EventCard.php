<?php
namespace App\View\Components;
use App\Models\Event;
use Illuminate\View\Component;

class EventCard extends Component
{
  /**
   * Event
   *
   * @var Event $event
   */

  public $event;

  /**
   * Event state
   * 
   * @var String $state
   */

  public $state;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct(Event $event, $state = NULL)
  {
    $this->event   = $event;
    $this->experts = collect($event->experts->pluck('fullname')->all());
    $this->state   = $state;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\View\View|string
   */
  public function render()
  {
    return view('web.pages.events.components.card');
  }
}
