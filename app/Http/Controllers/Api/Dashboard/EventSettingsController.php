<?php
namespace App\Http\Controllers\Api\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Models\User;
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
    ];
    return response()->json($settings);
  }

}
