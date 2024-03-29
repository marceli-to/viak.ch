<?php
namespace App\Http\Controllers;
use App\Models\TeamMember;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class ContactController extends BaseController
{
  protected $viewPath = 'web.pages.contact.';

  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Show the contact page
   *
   * @param  Request $request
   * @return \Illuminate\Http\Response
   */

  public function index()
  {
    return view(
      $this->viewPath . 'index', [
        'members' => TeamMember::published()->with('publishedImage')->orderBy('order', 'ASC')->get()
      ]
    );
  }
}
