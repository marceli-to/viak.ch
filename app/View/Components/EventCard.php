<?php
namespace App\View\Components;
use App\Models\Event;
use Illuminate\View\Component;
use App\Stores\BasketStore as BasketStore;
use App\Facades\Booking as BookingFacade;
use App\Facades\Bookmark as BookmarkFacade;

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
   * Event with a bookmark.
   * 
   */

  public $bookmark;


  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct(Event $event, $events = [])
  {
    $this->event    = $event;
    $this->bookmark = NULL;
    $this->experts  = collect($event->experts->pluck('fullname')->all());
    $this->inBasket = (int) (new BasketStore())->hasItem($this->event->uuid);

    // check for booking and bookmarks
    if (auth()->user())
    {
      $this->isBooked = BookingFacade::has($event, auth()->user());
      $this->bookmark = BookmarkFacade::find($event, auth()->user());
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
