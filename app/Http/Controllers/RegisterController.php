<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class RegisterController extends BaseController
{
  protected $viewPath = 'web.pages.register.';

  /**
   * Show the register form
   * @return \Illuminate\Http\Response
   */

  public function register()
  {
    return view($this->viewPath . 'form');
  }

}
