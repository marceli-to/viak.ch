<?php
namespace App\Http\Controllers;
use App\Models\Hero;
use App\Models\GridRow;
use App\Models\GridRowItem;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
  protected $viewPath = 'web.pages.home.';

  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Show the homepage
   *
   * @param  Request $request
   * @return \Illuminate\Http\Response
   */

  public function index(Request $request)
  {
    return view(
      $this->viewPath . 'index', [
        'hero' => Hero::published()->with('publishedImages')->where('slug', 'home')->first(),
        'openGraphImage' => Hero::published()->with('openGraphImage')->where('slug', 'home')->first()->openGraphImage,
        'grid' => GridRow::with('items.course.teaserImage', 'items.news.publishedImage', 'items')->orderBy('order')->get()
      ]
    );
  }

  public function maintenance()
  {
    return view($this->viewPath . 'maintenance');
  }
}
