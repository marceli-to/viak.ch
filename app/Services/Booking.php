<?php
namespace App\Services;
use Illuminate\Http\Request;
use App\Models\Booking as BookingModel;

class Booking
{

  /**
   * Get the next booking number
   * 
   * @return String number
   */

  public function number()
  {
    $bookings = BookingModel::withTrashed()->get();
       
    if ($bookings->count() == 0)
    {
      $number = 1;
    }
    else
    {
      $number = $bookings->last()->id + 1;
    }

    return $this->pad($number);
  }

  /**
   * Pad an input
   * 
   * @param Integer $number
   * @return String padded input
   */

  private function pad($number, $length = 6)
  {
    return str_pad($number, $length, "0", STR_PAD_LEFT);
  }

}