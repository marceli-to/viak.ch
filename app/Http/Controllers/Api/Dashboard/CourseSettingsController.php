<?php
namespace App\Http\Controllers\Api\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Models\Category;
use App\Models\Language;
use App\Models\Level;
use App\Models\Software;
use App\Models\Tag;
use Illuminate\Http\Request;

class CourseSettingsController extends Controller
{
  /**
   * Get course settings
   * 
   * @return \Illuminate\Http\Response
   */
  public function get()
  {
    $settings = [
      'categories' => Category::get(),
      'languages' => Language::get(),
      'levels' => Level::get(),
      'software' => Software::get(),
      'tags' => Tag::get(),
    ];
    return response()->json($settings);
  }

}
