<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Models\Event;
use App\Stores\BasketStore;
use Illuminate\Http\Request;

class StudentController extends BaseController
{
  protected $viewPath = 'web.pages.checkout.';

  /**
   * Show users basket
   * @return \Illuminate\Http\Response
   */

  public function basket()
  {
    return view($this->viewPath . 'basket');
  }

}
