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

    if (!isset($store['count']) || $store['count'] == 0)
    {
      $data['events'] = [];
      return response()->json($data);
    }

    $data = [
      'user_uuid' => isset($store['user_uuid']) ? $store['user_uuid'] : NULL,
      'invoice_address_uuid' => isset($store['invoice_address_uuid']) ? $store['invoice_address_uuid'] : NULL,
      'discount_code' => isset($store['discount_code']) ? $store['discount_code'] : NULL,
      'discount_uuid' => isset($store['discount_uuid']) ? $store['discount_uuid'] : NULL,
    ];

    // Add user address
    if (isset($store['user_uuid']))
    {
      $user = User::where('uuid', $store['user_uuid'])->first();
      $data['user_address'] = $user->address;
    }

    // Add invoice address
    if (isset($store['invoice_address_uuid']))
    {
      $user_address = UserAddress::where('uuid', $store['invoice_address_uuid'])->first();
      $data['invoice_address'] = $user_address->address;
    }

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

  public function store(Event $event, $rental = NULL)
  {
    $this->store->addItem($event->uuid);
    if ($rental)
    {
      $this->store->addRental($event->uuid);
    }
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
    if ($this->store->hasAttribute('items'))
    {
      $this->store->removeItem($event->uuid);
    }
    return response()->json($this->store->get());
  }

    /**
   * Remove an rental item from the basket
   * 
   * @param Event $event
   * @return \Illuminate\Http\Response
   */

   public function removeRental(Event $event)
   {
     if ($this->store->hasAttribute('items'))
     {
       $this->store->removeRentalFromItem($event->uuid);
     }
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
    foreach($items as $item)
    {
      $events[] = [
        'event' => Event::with('course', 'location', 'experts', 'dates')->where('uuid', $item['uuid'])->first(),
        'rental' => isset($item['rental']) ? $item['rental'] : FALSE,
      ];
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

    // change the following line so that events with "free_of_charge" are not included in the total
    $events = collect($events)->filter(function($event) {
      return !$event['free_of_charge'];
    });
    $total = collect($events)->sum('fee');
    
    $discount = 0;
    if ($discountCode)
    {
      $discount = Discount::apply($discountCode, $total);
    }

    // get all events that have rentals == true
    $events_with_rentals = collect($events)->filter(function($event) {
      return $event['has_rental'];
    });

    // add rentals cost to total. get the cost from config/invoice.php
    $total_rentals = count($events_with_rentals) * config('invoice.cost_rental');

    // @todo: fix vat on event
    $vat = round( ( ( $total - $discount ) / 100 * config('invoice.vat_rate')) * 20 ) / 20;
    $vat = 0;
    return [
      'discount' => $discount,
      'total' => $total + $total_rentals,
      'vat' => $vat,
      'grandTotal' => $total + $total_rentals
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
    $data = collect($events)->map(function($ev) {
      $event = $ev['event'];
      return [
        'uuid' => $event->uuid,
        'date' => $event->date,
        'fee'  => $event->courseFee,
        'free_of_charge' => $event->free_of_charge,
        'online' => $event->online ? TRUE : FALSE,
        'location' => [
          'description' => $event->location ? $event->location->description : NULL,
          'address' => $event->location ? $event->location->address : NULL,
          'map' => $event->location && $event->location->map ? $event->location->map : NULL,
        ],
        'isBooked' => BookingFacade::has($event, auth()->user()),
        'has_rentals' => $event->has_rentals,
        'has_rental' => $ev['rental'],
        'dates' => $event->dates->map(function($date) {
          return [
            'date' => $date->date,
            'date_long' => $date->date_long,
            'date_short' => $date->date_short,
            'time_start' => $date->time_start,
            'time_end' => $date->time_end,
          ];
        }),
        'experts' => $event->experts_fullname_string,
        'course' => [
          'title' => $event->course->title,
          'slug' => $event->course->slug,
          'uuid' => $event->course->uuid,
        ],
      ];
    });

    return $data;
  }
}
