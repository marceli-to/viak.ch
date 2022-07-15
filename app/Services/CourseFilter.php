<?php
namespace App\Services;
use Illuminate\Http\Request;
use App\Stores\CourseFilterStore;
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

class CourseFilter
{
  protected $category;
  protected $software;
  protected $language;
  protected $level;
  protected $location;
  protected $expert;
  protected $store;

  /**
   * Constructor
   */

  public function __construct()
  {
    $this->store = new CourseFilterStore();
  }

  /**
   * Get data and apply the filter on the result.
   * 
   * @param  \Illuminate\Http\Request $request
   * @return Array $data
   */
  public function apply($request = NULL, $map = FALSE)
  {
    $this->setCategory($request);
    $this->setSoftware($request);
    $this->setLanguage($request);
    $this->setLevel($request);
    $this->setLocation($request);
    $this->setExpert($request);

    // Start building a query
    $query = Course::query()->with('upcomingEvents.experts', 'categories', 'softwares');

    // Filter by 'category'
    if ($this->category)
    {
      $query->whereHas('categories', function ($query) {
        $query->where('id', $this->category);
      });
    }

    // Filter by 'software'
    if ($this->software)
    {
      $query->whereHas('softwares', function ($query) {
        $query->where('id', $this->software);
      });
    }

    // Filter by 'language'
    if ($this->language)
    {
      $query->whereHas('languages', function ($query) {
        $query->where('id', $this->language);
      });
    }

    // Filter by 'level'
    if ($this->level)
    {
      $query->whereHas('levels', function ($query) {
        $query->where('id', $this->level);
      });
    }

    // Filter by 'expert'
    if ($this->expert)
    {
      $query->whereHas('upcomingEvents.experts', function ($query) {
        $query->where('uuid', $this->expert);
      });
    }

    // Filter by 'location'
    if ($this->location)
    {
      if ($this->location == 'online')
      {
        $query->online();
      }
      if ($this->location == 'offline')
      {
        $query->offline();
      }
    }

    if ($map)
    {
      return $this->map(
        $query->get(),
        $this->expert
      );
    }

    return [];
  }

  /**
   * Reset the filter.
   * 
   * @return Void
   */
  public function reset()
  {
    return $this->store->clear();
  }

  /**
   * Get filter settings
   *
   * @return \Illuminate\Http\Response
   */

  public function getSettings()
  {
    return [
      'settings' => [
        'experts' => $this->getExperts(),
        'categories' => $this->getCategories(),
        'software' => $this->getSoftware(),
        'languages' => $this->getLanguages(),
        'levels' => $this->getLevels(),
      ],
      'filter' => $this->store->get(),
    ];
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
   * Set current category as filter item.
   * 
   */
  
  private function setCategory($request)
  {
    $this->category = $this->store->getAttribute('items.category');
    if ($request && $request->input('category'))
    {
      $this->category = $request->input('category') !== 'null' ? $request->input('category') : NULL;
      $this->store->setAttribute('items.category', $this->category);
    }
  }
  
  /**
   * Set current software as filter item.
   * 
   */
  
  private function setSoftware($request)
  {
    $this->software = $this->store->getAttribute('items.software');
    if ($request && $request->input('software'))
    {
      $this->software = $request->input('software') !== 'null' ? $request->input('software') : NULL;
      $this->store->setAttribute('items.software', $this->software);
    }
  }

  /**
   * Set current language as filter item.
   * 
   */
  
  private function setLanguage($request)
  {
    $this->language = $this->store->getAttribute('items.language');
    if ($request && $request->input('language'))
    {
      $this->language = $request->input('language') !== 'null' ? $request->input('language') : NULL;
      $this->store->setAttribute('items.language', $this->language);
    }
  }

  /**
   * Set current level as filter item.
   * 
   */
  private function setLevel($request)
  {
    $this->level = $this->store->getAttribute('items.level');
    if ($request && $request->input('level'))
    {
      $this->level = $request->input('level') !== 'null' ? $request->input('level') : NULL;
      $this->store->setAttribute('items.level', $this->level);
    }
  }

  /**
   * Set current expert as filter item.
   * 
   */
  private function setExpert($request)
  {
    $this->expert = $this->store->getAttribute('items.expert');
    if ($request && $request->input('expert'))
    {
      $this->expert = $request->input('expert') !== 'null' ? $request->input('expert') : NULL;
      $this->store->setAttribute('items.expert', $this->expert);
    }
  }

  /**
   * Set current location as filter item.
   * 
   */
  private function setLocation($request)
  {
    $this->location = $this->store->getAttribute('items.location');
    if ($request && $request->input('location'))
    {
      $this->location = $request->input('location') !== 'null' ? $request->input('location') : NULL;
      $this->store->setAttribute('items.location', $this->location);
    }
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
          'date' => $event->date,
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
    return ['courses' => $data, 'filter' => $this->store->get()];
  }

}