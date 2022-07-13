<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\User;
class HomeController extends BaseController
{
  protected $viewPath = 'web.pages.home.';

  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Show the homepage
   *
   * @param  Request $request
   * @return \Illuminate\Http\Response
   */

  public function index(Request $request)
  {
    $path = resource_path('lang/en.json');
    $json = json_decode(file_get_contents($path), true);
    dd($json);
    dd(__('*', [], 'en'));
    return view($this->viewPath . 'index');
  }
}
