<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
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
   * Filter courses.
   * 
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function filter(Request $request)
  { 
    // Start building a query
    $query = Course::query()->with('upcomingEvents.experts', 'categories', 'softwares');

    // Filter by 'category'
    if ($request->input('category'))
    {
      $category = $request->input('category');
      $query->whereHas('categories', function ($query) use ($category) {
        $query->where('id', $category);
      });
    }

    // Filter by 'software'
    if ($request->input('software'))
    {
      $software = $request->input('software');
      $query->whereHas('softwares', function ($query) use ($software) {
        $query->where('id', $software);
      });
    }

    // Filter by 'language'
    if ($request->input('language'))
    {
      $language= $request->input('language');
      $query->whereHas('languages', function ($query) use ($language) {
        $query->where('id', $language);
      });
    }

    // Filter by 'level'
    if ($request->input('level'))
    {
      $level= $request->input('level');
      $query->whereHas('levels', function ($query) use ($level) {
        $query->where('id', $level);
      });
    }

    // Filter by 'expert'
    if ($request->input('expert'))
    {
      $expert = $request->input('expert');
      $query->whereHas('upcomingEvents.experts', function ($query) use ($expert) {
        $query->where('uuid', $expert);
      });
    }

    // Filter by 'location'
    if ($request->input('location'))
    {
      $location = $request->input('location');
      if ($location == 'online')
      {
        $query->online();
      }
      if ($location == 'offline')
      {
        $query->offline();
      }
    }

    $data = $this->map(
      $query->get(), 
      $request->input('expert')
    );

    return response()->json($data);
  }

  /**
   * Search courses.
   * 
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function search(Request $request)
  { 
   //$query = Course::search($request->input('keyword'))->get();

    $query = Course::search($request->input('keyword'))->query(function (\Illuminate\Database\Eloquent\Builder $builder) {
      $builder->with(['upcomingEvents.experts', 'categories', 'softwares']);
    })->get();

    $data = $this->map(
      $query, 
    );

    return response()->json($data);
  }




  /**
   * Get filter settings
   *
   * @return \Illuminate\Http\Response
   */

  public function settings()
  {
    $data = [
      'experts' => $this->getExperts(),
      'categories' => $this->getCategories(),
      'software' => $this->getSoftware(),
      'languages' => $this->getLanguages(),
      'levels' => $this->getLevels(),
    ];
    return response()->json($data);
  }

  /**
   * Get experts assigned to events.
   * 
   * @return array
   */

  private function getExperts()
  {
    $userIds = EventUser::get(['user_id'])->unique('user_id')->pluck('user_id');
    $users = User::whereIn('id', $userIds)->orderBy('name')->get();
    $data = $users->pluck('fullname', 'uuid');
    return $data->all();
  }

  /**
   * Get categories assigned to courses.
   * 
   * @return array
   */
  
  private function getCategories()
  {
    $ids = CategoryCourse::get(['category_id'])->unique('category_id')->pluck('category_id');
    $categories = Category::whereIn('id', $ids)->get();
    $data = $categories->pluck('description', 'id');
    return $data->all();
  }

  /**
   * Get software assigned to courses.
   * 
   * @return array
   */
  
  private function getSoftware()
  {
    $ids = CourseSoftware::get(['software_id'])->unique('software_id')->pluck('software_id');
    $software = Software::whereIn('id', $ids)->get();
    $data = $software->pluck('description', 'id');
    return $data->all();
  }

  /**
   * Get languages assigned to courses.
   * 
   * @return array
   */
  
  private function getLanguages()
  {
    $ids = CourseLanguage::get(['language_id'])->unique('language_id')->pluck('language_id');
    $language = Language::whereIn('id', $ids)->get();
    $data = $language->pluck('description', 'id');
    return $data->all();
  }

  /**
   * Get levels assigned to courses.
   * 
   * @return array
   */
  
  private function getLevels()
  {
    $ids = CourseLevel::get(['level_id'])->unique('level_id')->pluck('level_id');
    $level = Level::whereIn('id', $ids)->get();
    $data = $level->pluck('description', 'id');
    return $data->all();
  }

  /**
   * Map filtered data for JSON output
   * 
   * @param Collection courses
   * @return Array
   */
  private function map($courses, $expertUuid = NULL)
  {
    $data = [];
    foreach($courses as $course)
    {
      if ($course->hasUpcomingEvents())
      { 
        $event = $course->upcomingEvents->first();
        
        // Get the first upcoming event with a matching expert uuid.
        // The 'upcomingEvents' are sorted by date, so the first 
        // matching event is the closest to todays date.
        if ($expertUuid)
        {
          $filtered = $course->upcomingEvents->filter(function ($value, $key) use ($expertUuid) {
            return $value->experts->firstWhere('uuid', $expertUuid);
          });
          $event = collect($filtered->all())->first();
        }

        $data[] = [
          'uuid' => $course->uuid,
          'slug' => $course->slug,
          'title' => $course->title,
          'date' => date('d. F Y', strtotime($event->date)),
          'categories' => collect($course->categories->pluck('description')->all())->implode(', '),
          'experts' => collect($event->experts->pluck('fullname')->all())->implode(', '),
          'fee' => $course->fee,
          'online' => $course->online ? TRUE : FALSE,
          'upcoming' => TRUE,
        ];
      }
      else
      {
        $data[] = [
          'uuid' => $course->uuid,
          'slug' => $course->slug,
          'title' => $course->title,
          'categories' => collect($course->categories->pluck('description')->all())->implode(', '),
          'upcoming' => FALSE,
        ];
      }
    }
    return $data;
  }
}
