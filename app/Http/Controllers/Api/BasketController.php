<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Event;
use App\Models\Country;
use App\Models\DiscountCode;
use App\Stores\BasketStore;
use App\Facades\Booking as BookingFacade;
use App\Facades\Discount;
use App\Http\Resources\StudentResource;
use App\Http\Requests\InvoiceAddressUpdateRequest;
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
    $store = $this->store->get();

    $data = [
      'user_uuid' => isset($store['user_uuid']) ? $store['user_uuid'] : NULL,
      'invoice_address_uuid' => isset($store['invoice_address_uuid']) ? $store['invoice_address_uuid'] : NULL,
      'discount_code' => isset($store['discount_code']) ? $store['discount_code'] : NULL,
      'discount_uuid' => isset($store['discount_uuid']) ? $store['discount_uuid'] : NULL,
    ];

    // Events
    $data['events'] = $this->getEvents($store['items']);

    // Totals
    $data['totals'] = $this->getTotals(
      $this->getEvents($store['items']), 
      $data['discount_uuid']
    );
    return response()->json($data);
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
   * Add the user
   * 
   * @param Request $request
   * @return \Illuminate\Http\Response
   */

  public function addUser(Request $request)
  {
    $user = User::findOrFail(auth()->user()->id);
    $this->store->addAttribute('user_uuid', $user->uuid);

    $this->store->removeAttribute('invoice_address_uuid');
    if ($request->input('address_uuid'))
    {
      $this->store->addAttribute('invoice_address_uuid', $request->input('address_uuid'));
    }
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
    $this->store->removeAttribute('discount_code');
    $this->store->removeAttribute('discount_uuid');

    if ($request->input('discount_code'))
    {
      $discountCode = Discount::getByCode(
        $request->input('discount_code')
      );

      if (Discount::validate($discountCode->uuid))
      {
        $this->store->addAttribute('discount_code', $discountCode->code);
        $this->store->addAttribute('discount_uuid', $discountCode->uuid);
      }
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

  private function getTotals($events, $discountCode = NULL)
  {
    $total = collect($events)->sum('fee');
    $discount = 0;
    if ($discountCode)
    {
      $discount = Discount::apply($discountCode, $total);
    }

    // @todo: fix vat on event
    $vat = round( ( ( $total - $discount ) / 100 * 7.7 ) * 20 ) / 20;
    $vat = 0;
    return [
      'discount' => $discount,
      'total' => $total,
      'vat' => $vat,
      'grandTotal' => ($total - $discount) + $vat
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
        'isBooked' => BookingFacade::has($event, auth()->user()),
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
