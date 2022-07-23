<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use App\Stores\BasketStore;
use Illuminate\Http\Request;

class BasketController extends Controller
{
  protected $store;

  /**
   * Constructor
   */

  public function __construct()
  {
    $this->store = new BasketStore();
  }

  /**
   * Get all basket items
   * 
   * @return \Illuminate\Http\Response
   */

  public function get()
  {
    $items = $this->store->getItems();
    $events = [];
    foreach($items as $item)
    {
      $events[] = Event::with('course', 'location', 'experts', 'dates')->where('uuid', $item)->first();
    }
    
    return response()->json($this->map($events));
  }

  /**
   * Store an item in the basket
   * 
   * @param Event $event
   * @return \Illuminate\Http\Response
   */

  public function store(Event $event)
  {
    $this->store->addItem($event->uuid);
    return response()->json($this->store->get());
  }

  /**
   * Remove an item from the basket
   * 
   * @param Event $event
   * @return \Illuminate\Http\Response
   */

  public function destroy(Event $event)
  {
    $this->store->removeItem($event->uuid);
    return response()->json($this->store->get());
  }

  /**
   * Map data for JSON output
   * 
   * @param Collection events
   * @return Array
   */
  private function map($events)
  {
    $data = collect($events)->map(function($event) {
      return [
        'uuid' => $event->uuid,
        'date' => $event->date,
        'fee'  => $event->fee ? $event->fee : $event->course->fee,
        'online' => $event->online ? TRUE : FALSE,
        'location' => [
          'description' => $event->location ? $event->location->description : NULL,
          'address' => $event->location ? $event->location->address : NULL,
        ],
        'dates' => $event->dates->map(function($date) {
          return [
            'date' => $date->date,
            'time_start' => $date->time_start,
            'time_end' => $date->time_end,
          ];
        }),
        'experts' => collect($event->experts->pluck('fullname')->all())->implode(', '),
        'course' => [
          'title' => $event->course->title,
        ],
      ];
    });

    return $data;
  }
}
