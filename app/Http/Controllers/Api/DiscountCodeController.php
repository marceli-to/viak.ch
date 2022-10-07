<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\DiscountCode;
use App\Services\Discount as DiscountService;
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
    $discountCode = DiscountCode::where('code', $code)->first();
    if ($discountCode && $discountCode->isValid())
    {
      return response()->json(200);
    }
    return response()->json('code invalid', 422);
  }

}
