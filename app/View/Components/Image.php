<?php
namespace App\View\Components;
use Illuminate\View\Component;
use App\Models\Image as ImageModel;

class Image extends Component
{

  /**
   * Image
   *
   * @var Image $image
   */
  public $image;

  /**
   * Ratio
   *
   * @var String
   */
  public $ratio;

  /**
   * Wrapper class
   *
   * @var String
   */
  public $wrapperClass;

  /**
   * Show caption
   *
   * @var Boolean
   */
  public $showCaption;

  /**
   * Maximum sizes for responsive images
   *
   * @var Array
   */
  public $maxSizes;

  /**
   * Width of the image
   *
   * @var String
   */
  public $width; 

  /**
   * Height of the image
   *
   * @var String
   */
  public $height; 

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($image = NULL, $ratio = NULL, $wrapperClass = NULL, $showCaption = FALSE, $maxSizes = [], $width = NULL, $height = NULL)
  {
    $this->image = $image;
    $this->maxSizes = $maxSizes;
    $this->ratio = $ratio;
    $this->wrapperClass = $wrapperClass;
    $this->showCaption = $showCaption;
    $this->width = $width;
    $this->height = $height;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\View\View|string
   */
  public function render()
  {
    return view('web.components.content.image');
  }
}
