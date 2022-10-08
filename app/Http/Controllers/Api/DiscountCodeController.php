<?php
namespace App\Http\Controllers\Api;
use App\Facades\Discount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiscountCodeController extends Controller
{
  /**
   * Validate a discount code
   * 
   * @param String $code
   * @return \Illuminate\Http\Response
   */

  public function check($code = NULL)
  {
    $discountCode = Discount::getByCode($code);
    if ($discountCode && Discount::validate($discountCode->uuid))
    {
      return response()->json('code valid', 200);
    }
    return response()->json('code invalid', 418);
  }

}
