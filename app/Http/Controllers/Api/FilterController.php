<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Services\CourseFilter;
use App\Models\User;
use App\Models\EventUser;
use App\Models\CategoryCourse;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseSoftware;
use App\Models\Software;
use App\Models\CourseLanguage;
use App\Models\Language;
use App\Models\CourseLevel;
use App\Models\Level;
use Illuminate\Http\Request;

class FilterController extends Controller
{
  /**
   * Apply a filter.
   * 
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function filter(Request $request)
  { 
    return response()->json(
      (new CourseFilter())->apply($request, true)
    );
  }

  /**
   * Get filter settings.
   *
   * @return \Illuminate\Http\Response
   */

  public function settings()
  {
    return response()->json(
      (new CourseFilter())->getSettings()
    );
  }

  /**
   * Search courses.
   * 
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  // public function search(Request $request)
  // { 
  //   $query = Course::search($request->input('keyword'))->query(function (\Illuminate\Database\Eloquent\Builder $builder) {
  //     $builder->with(['upcomingEvents.experts', 'categories', 'softwares']);
  //   })->get();

  //   $data = $this->map(
  //     $query, 
  //   );

  //   return response()->json($data);
  // }
}
