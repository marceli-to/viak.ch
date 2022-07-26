<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Stores\BasketStore;
use App\Services\Booking as BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
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
   * Store all basket items as booking.
   * 
   * @return \Illuminate\Http\Response
   */

  public function store()
  {
    if ($this->store->getItemsCount())
    {
      (new BookingService())->create($this->store->get());
      $this->store->clear();
    }
    return response()->json(true);
  }

  /**
   * Cancel a booking
   * 
   * @param Booking $booking
   * @return \Illuminate\Http\Response
   */

  public function cancel(Booking $booking)
  { 
    (new BookingService())->cancel($booking);
    return response()->json('successfully deleted');
  }

}
