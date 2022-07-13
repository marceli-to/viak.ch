<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\Request;

class ExpertController extends BaseController
{
  protected $viewPath = 'web.pages.experts.';

  /**
   * Show a list of experts
   * @return \Illuminate\Http\Response
   */

  public function list()
  {
    return view($this->viewPath . 'list', ['experts' => User::get()]);
  }

  /**
   * Show an expert.
   * 
   * @param  Expert $expert
   * @return \Illuminate\Http\Response
   */

  public function show(User $user)
  {
    return view($this->viewPath . 'show', ['expert' => User::findOrFail($user)]);
  }
}
