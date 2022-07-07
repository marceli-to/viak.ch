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
use Illuminate\Http\Request;

class FilterController extends Controller
{

  /**
   * Get a filtered ist of apartments
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
      $software= $request->input('software');
      $query->whereHas('softwares', function ($query) use ($software) {
        $query->where('id', $software);
      });
    }

    // Filter by 'expert'
    if ($request->input('expert')) {
      $expert = $request->input('expert');
      $query->whereHas('upcomingEvents.experts', function ($query) use ($expert) {
        $query->where('uuid', $expert);
      });
    }

    $data = $this->map($query->get(), $request->input('expert'));
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
        // Get the first upcoming event with a matching expert uuid,
        // the 'upcomingEvents' are sorted by date, so first matching
        // is the closest to todays date.
        $filtered = $course->upcomingEvents->filter(function ($value, $key) use ($expertUuid) {
          return $value->experts->firstWhere('uuid', $expertUuid);
        });
        $event = collect($filtered->all())->first();
       
        $data[] = [
          'uuid' => $course->uuid,
          'slug' => $course->slug,
          'title' => $course->title,
          'date' => date('d. F Y', strtotime($event->date)),
          'categories' => collect($course->categories->pluck('description')->all())->implode(', '),
          'experts' => collect($event->experts->pluck('fullname')->all())->implode(', '),
          'fee' => $course->fee,
          'online' => $event->online ? TRUE : FALSE,
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
