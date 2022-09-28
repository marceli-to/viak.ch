<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use App\Stores\BasketStore;
use App\Services\Booking as BookingService;
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
    return response()->json(
      [
        'events' => $this->getEvents($items),
        'totals' => $this->getTotals($this->getEvents($items))
      ]
    );
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
   * Store user information in the basket
   * 
   * @param Request $request
   * @return \Illuminate\Http\Response
   */

  public function addUser(Request $request)
  {
    $user = User::find(auth()->user()->id);
    $data = [
      'id' => auth()->user()->id,
      'address' => $request->input('invoice_address') ? $request->input('invoice_address') : null,
      'update_profile' => $request->input('update_profile'),
    ];

    if ($request->input('invoice_address'))
    {
      
      $user->has_invoice_address = $request->input('update_profile');
      $user->invoice_address = $request->input('invoice_address');
      $user->save();
    }
    $this->store->addUser($data);
    return response()->json($this->store->get());
  }

  /**
   * Store payment information in the basket
   * 
   * @param Request $request
   * @return \Illuminate\Http\Response
   */

  public function addPayment(Request $request)
  {
    if ($request->input('voucher'))
    {
     // $this->store->addVoucher($data);
    }
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
   * Get events based on store items
   * 
   * @param Array $items
   * @return Array 
   */

  private function getEvents($items, $map = TRUE)
  {
    $events = [];
    foreach($items as $item)
    {
      $events[] = Event::with('course', 'location', 'experts', 'dates')->where('uuid', $item)->first();
    }
    
    return $map ? $this->map($events) : $events;
  }

  /**
   * Get totals based on store items
   * 
   * @param Array $items
   * @return Array 
   */

  private function getTotals($events = [])
  {
    $total = collect($events)->sum('fee');
    // @todo: fix vat on event
    $vat = round( ($total / 100 * 7.7) * 20 ) / 20;
    $vat = 0;
    return [
      'total' => $total,
      'vat' => $vat,
      'grandTotal' => $total + $vat
    ];
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
        'fee'  => $event->courseFee,
        'online' => $event->online ? TRUE : FALSE,
        'location' => [
          'description' => $event->location ? $event->location->description : NULL,
          'address' => $event->location ? $event->location->address : NULL,
        ],
        'isBooked' => (new BookingService())->has($event, auth()->user()),
        'dates' => $event->dates->map(function($date) {
          return [
            'date' => $date->date,
            'date_short' => $date->date_short,
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
