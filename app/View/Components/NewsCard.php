<?php
namespace App\View\Components;
use App\Models\News;
use Illuminate\View\Component;

class NewsCard extends Component
{
  /**
   * News id
   *
   * @var Integer $id
   */

  public $id;

  /**
   * News article
   *
   * @var News $news
   */

  public $news;

  /**
   * Link target
   *
   * @var String $target
   */

  public $target;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($id = NULL)
  {
    $this->news = News::find($id);
    $this->target = $this->news->link ? \AppHelper::linkTarget($this->news->link) : NULL;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\View\View|string
   */
  public function render()
  {
    return view('web.components.content.card-news');
  }
}
