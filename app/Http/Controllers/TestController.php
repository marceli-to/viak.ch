<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class TestController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Test method
   *
   * @param  Request $request
   * @return \Illuminate\Http\Response
   */

  public function test()
  {
    dd('test');
  }
}
