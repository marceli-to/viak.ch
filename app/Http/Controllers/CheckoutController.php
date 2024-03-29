<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Models\Event;
use App\Stores\BasketStore;
use Illuminate\Http\Request;

class CheckoutController extends BaseController
{
  protected $viewPath = 'web.pages.checkout.';

  /**
   * Show users basket
   * @return \Illuminate\Http\Response
   */

  public function index()
  {
    return view($this->viewPath . 'index');
  }

  /**
   * Show users info
   * @return \Illuminate\Http\Response
   */

   public function user()
   {
     return view($this->viewPath . 'index');
   }

  /**
   * Show the confirmation page
   * @return \Illuminate\Http\Response
   */

  public function confirmation()
  {
    return view($this->viewPath . 'confirmation');
  }

}
