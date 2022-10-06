<?php
namespace App\Http\Controllers\Api;
use App\Models\Country;
use App\Http\Resources\CountryResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountryController extends Controller
{
  /**
   * Get all the countries
   * 
   * @return \Illuminate\Http\Response
   */
  public function get()
  {  
    $data = CountryResource::collection(
      Country::orderBy('order')->get()
    );
    return response()->json($data);
  }

}
