<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class IndividualTrainingController extends BaseController
{
  protected $viewPath = 'web.pages.courses.';

  /**
   * Show the invidual training page
   * @return \Illuminate\Http\Response
   */

  public function index()
  {
    return view($this->viewPath . 'individual-training');
  }
}
