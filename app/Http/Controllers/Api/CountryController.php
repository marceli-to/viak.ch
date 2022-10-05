<?php
namespace App\Http\Controllers\Api;
use App\Models\Country;
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
    return response()->json(Country::orderBy('order')->get());
  }

}
