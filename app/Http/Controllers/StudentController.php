<?php
namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends BaseController
{
  protected $viewPath = 'web.pages.students.';

  /**
   * Show the student register form
   * @return \Illuminate\Http\Response
   */

  public function register()
  {
    return view($this->viewPath . 'register');
  }

  /**
   * Show the students profile
   * @return \Illuminate\Http\Response
   */

  public function profile()
  {
    return view($this->viewPath . 'profile');
  }


}
