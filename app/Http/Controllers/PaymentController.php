<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends BaseController
{
  protected $viewPath = 'web.pages.payment.';

  /**
   * Show the booking
   * @param Booking $booking
   * @return \Illuminate\Http\Response
   */

  public function index(Booking $booking)
  {
    $this->authorize('view', $booking);
    $booking = Booking::with('user')->findOrFail($booking->id);
    return view($this->viewPath . 'index', ['booking' => $booking]);
  }

}
