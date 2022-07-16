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
   * Is bookmarked
   *
   * @var Boolean $isBookmark
   */

  public $isBookmark;

  /**
   * Is booked
   *
   * @var Boolean $isBooked
   */

  public $isBooked;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct(Event $event, $isBookmark = FALSE, $isBooked = FALSE)
  {
    $this->event   = $event;
    $this->experts = collect($event->experts->pluck('fullname')->all());
    $this->isBookmark = $isBookmark;
    $this->isBooked = $isBooked;
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
