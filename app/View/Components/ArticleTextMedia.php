<?php
namespace App\View\Components;
use Illuminate\View\Component;

class ArticleTextMedia extends Component
{
  /**
   * Title
   *
   * @var String $title
   */
  public $title;

  /**
   * Subtitle
   *
   * @var String $subtitle
   */
  public $subtitle;

  /**
   * Text
   *
   * @var String $text
   */
  public $text;

  /**
   * Image
   *
   * @var String $image
   */
  public $image;

  /**
   * Reverse
   *
   * @var Boolean $reverse
   */
  public $reverse;


  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($title = NULL, $subtitle = NULL, $text = NULL, $image = NULL, $reverse = FALSE)
  {
    $this->title = $title;
    $this->subtitle = $subtitle;
    $this->text = $text;
    $this->image = $image;
    $this->reverse = $reverse;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\View\View|string
   */
  public function render()
  {
    return view('web.components.content.article-text-media');
  }
}
