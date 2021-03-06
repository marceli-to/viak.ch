<?php
namespace App\View\Components;
use App\Models\Event;
use Illuminate\View\Component;
use App\Stores\BasketStore as BasketStore;
use App\Services\Booking as BookingService;

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
   * Event exists in basket
   * 
   */

  public $inBasket;

  /**
   * Event is booked.
   * 
   */

  public $isBooked;

  /**
   * Event is bookmarked.
   * 
   */

  public $isBookmarked;


  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct(Event $event, $events = [])
  {
    $this->event   = $event;
    $this->experts = collect($event->experts->pluck('fullname')->all());
    $this->inBasket = (int) (new BasketStore())->getItem($this->event->uuid);

    // check for booking && bookmark
    if (auth()->user())
    {
      $this->isBookmarked = FALSE;
      $this->isBooked = (new BookingService())->has($event, auth()->user());
    }

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
