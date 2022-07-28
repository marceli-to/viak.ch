<?php
namespace App\Http\Controllers\Api\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;

class EventSettingsController extends Controller
{
  /**
   * Get event settings
   * 
   * @return \Illuminate\Http\Response
   */
  public function get()
  {
    $settings = [
      'experts' => User::experts()->orderBy('firstname')->get(),
      'locations' => Location::get(),
    ];
    return response()->json($settings);
  }

}
