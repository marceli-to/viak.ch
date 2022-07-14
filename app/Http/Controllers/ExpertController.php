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
    $experts = User::experts()->published()->visible()->get();
    return view($this->viewPath . 'list', ['experts' => $experts]);
  }

  /**
   * Show an expert.
   * 
   * @param  Expert $expert
   * @return \Illuminate\Http\Response
   */

  public function show($slug = NULL, User $user)
  {
    $expert = User::experts()->published()->visible()->with('events.course')->findOrFail($user->id);
    return view($this->viewPath . 'show', ['expert' => $expert]);
  }
}
