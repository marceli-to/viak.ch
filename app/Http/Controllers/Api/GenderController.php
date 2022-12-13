<?php
namespace App\Http\Controllers\Api;
use App\Models\Gender;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GenderController extends Controller
{
  /**
   * Get all the genders
   * 
   * @return \Illuminate\Http\Response
   */
  public function get()
  { 
    return response()->json(Gender::all());
  }
}
