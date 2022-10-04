<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

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
    return view($this->viewPath . 'index');
  }
}
