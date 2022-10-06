<?php
namespace App\Http\Controllers\Api\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Models\DiscountCode;
use App\Services\Discount as DiscountService;
use App\Http\Requests\DiscountCodeStoreRequest;
use App\Http\Requests\DiscountCodeUpdateRequest;
use Illuminate\Http\Request;

class DiscountCodeController extends Controller
{
  /**
   * Get a list of discountCodes
   * 
   * @param String $constraint
   * @return \Illuminate\Http\Response
   */
  public function get()
  {
    return response()->json([
      'unused' => DiscountCode::unused()->get(),
      'used' => DiscountCode::used()->get(),
    ]);
  }

  /**
   * Get a single discountCode
   * 
   * @param DiscountCode $discountCode
   * @return \Illuminate\Http\Response
   */
  public function find(DiscountCode $discountCode)
  {
    $discountCode = DiscountCode::find($discountCode->id);
    return response()->json($discountCode);
  }

  /**
   * Create a discountCode
   * 
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return response()->json(
      (new DiscountService())->create()
    );
  }

  /**
   * Store a newly created discountCode
   *
   * @param  \Illuminate\Http\DiscountCodeStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(DiscountCodeStoreRequest $request)
  {
    $discountCode = DiscountCode::create(
      array_merge(
        $request->all(), 
        ['uuid' => \Str::uuid()]
      )
    );

    return response()->json(['discountCodeId' => $discountCode->id]);
  }

  /**
   * Update a discountCode for a given discountCode
   *
   * @param DiscountCode $discountCode
   * @param  \Illuminate\Http\DiscountCodeUpdateRequest $request
   * @return \Illuminate\Http\Response
   */
  public function update(DiscountCode $discountCode, DiscountCodeUpdateRequest $request)
  {
    $discountCode = DiscountCode::findOrFail($discountCode->id);
    $discountCode->update($request->all());
    return response()->json('successfully updated');
  }

  /**
   * Remove a discountCode
   *
   * @param  DiscountCode $discountCode
   * @return \Illuminate\Http\Response
   */
  public function destroy(DiscountCode $discountCode)
  {
    $discountCode->delete();
    return response()->json('successfully deleted');
  }
}
