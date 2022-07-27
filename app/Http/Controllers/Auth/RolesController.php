<?php
namespace App\Http\Controllers\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Role;

class RolesController extends BaseController
{
  protected $viewPath = 'auth.';
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
    $this->middleware('auth');
  }

  public function index()
  {
    return view($this->viewPath . 'roles', ['roles' => auth()->user()->roles]);
  }

  /**
   * Sets the selected role
   * 
   * @param Role $role
   * @return \Illuminate\Http\Response
   */
  public function set(Role $role)
  {
    if (auth()->user()->hasRole($role))
    {
      session(['selected-role' => $role]);
      if (auth()->user()->isAdmin() && $role->id == Role::ADMIN)
      {
        return redirect(RouteServiceProvider::DASHBOARD);
      }
    }
    return redirect(RouteServiceProvider::HOME);
  }

}
