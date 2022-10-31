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
use App\Models\CourseTag;
use App\Models\Tag;

class CourseFilter
{
  protected $category;
  protected $software;
  protected $language;
  protected $level;
  protected $tag;
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
    $this->setTag($request);

    // Start building a query
    $query = Course::query()->published()->with('upcomingAndPublishedEvents.experts', 'categories', 'softwares', 'teaserImage');

    // Filter by 'category'
    if ($this->category)
    {
      $query->whereHas('categories', function ($query) {
        $query->where('uuid', $this->category);
      });
    }

    // Filter by 'software'
    if ($this->software)
    {
      $query->whereHas('softwares', function ($query) {
        $query->where('uuid', $this->software);
      });
    }

    // Filter by 'language'
    if ($this->language)
    {
      $query->whereHas('languages', function ($query) {
        $query->where('uuid', $this->language);
      });
    }

    // Filter by 'level'
    if ($this->level)
    {
      $query->whereHas('levels', function ($query) {
        $query->where('uuid', $this->level);
      });
    }

    // Filter by 'tag'
    if ($this->tag)
    {
      $query->whereHas('tags', function ($query) {
        $query->where('uuid', $this->tag);
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

    
    // Filter out cancelled
    // $query->whereHas('upcomingAndPublishedEvents', function ($query) {
    //   $query->where('cancelled', 0);
    // });

    // $query->whereHas('upcomingAndPublishedEvents', function ($query) {
    //   $query->where('publish', 1);
    // });


    if ($map)
    {
      return $this->map(
        $query->orderBy('order', 'ASC')->get(),
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
        'tags' => $this->getTags(),
      ],
      'filter' => NULL,
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
    $users = User::published()->visible()->whereIn('id', $userIds)->orderBy('firstname')->get();
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
    $data = $categories->pluck('description', 'uuid');
    return $data->sort()->all();
  }

  /**
   * Get software assigned to courses.
   * 
   * @return array
   */
  
  private function getSoftware()
  {
    $ids = CourseSoftware::get(['software_id'])->unique('software_id')->pluck('software_id');
    $software = Software::whereIn('id', $ids)->orderBy('description')->get();
    $data = $software->pluck('description', 'uuid');
    return $data->sort()->all();
  }

  /**
   * Get languages assigned to courses.
   * 
   * @return array
   */
  
  private function getLanguages()
  {
    $ids = CourseLanguage::get(['language_id'])->unique('language_id')->pluck('language_id');
    $language = Language::whereIn('id', $ids)->orderBy('description')->get();
    $data = $language->pluck('description', 'uuid');
    return $data->sort()->all();
  }

  /**
   * Get levels assigned to courses.
   * 
   * @return array
   */
  
  private function getLevels()
  {
    $ids = CourseLevel::get(['level_id'])->unique('level_id')->pluck('level_id');
    $level = Level::whereIn('id', $ids)->orderBy('description')->get();
    $data = $level->pluck('description', 'uuid');
    return $data->sort()->all();
  }

  /**
   * Get tags assigned to courses.
   * 
   * @return array
   */
  
  private function getTags()
  {
    $ids = CourseTag::get(['tag_id'])->unique('tag_id')->pluck('tag_id');
    $tag = Tag::whereIn('id', $ids)->orderBy('description')->get();
    $data = $tag->pluck('description', 'uuid');
    return $data->sort()->all();
  }

  /**
   * Set current category as filter item.
   * 
   */
  
  private function setCategory($request)
  {
    if ($request && $request->input('category'))
    {
      $this->category = $request->input('category') !== 'null' ? $request->input('category') : NULL;
    }
  }
  
  /**
   * Set current software as filter item.
   * 
   */
  
  private function setSoftware($request)
  {
    if ($request && $request->input('software'))
    {
      $this->software = $request->input('software') !== 'null' ? $request->input('software') : NULL;
    }
  }

  /**
   * Set current language as filter item.
   * 
   */
  
  private function setLanguage($request)
  {
    if ($request && $request->input('language'))
    {
      $this->language = $request->input('language') !== 'null' ? $request->input('language') : NULL;
    }
  }

  /**
   * Set current level as filter item.
   * 
   */
  private function setLevel($request)
  {
    // $this->level = $this->store->getAttribute('attributes.level');
    if ($request && $request->input('level'))
    {
      $this->level = $request->input('level') !== 'null' ? $request->input('level') : NULL;
      // $this->store->setAttribute('attributes.level', $this->level);
    }
  }

  /**
   * Set current expert as filter item.
   * 
   */
  private function setExpert($request)
  {
    if ($request && $request->input('expert'))
    {
      $this->expert = $request->input('expert') !== 'null' ? $request->input('expert') : NULL;
    }
  }

  /**
   * Set current location as filter item.
   * 
   */
  private function setLocation($request)
  {
    if ($request && $request->input('location'))
    {
      $this->location = $request->input('location') !== 'null' ? $request->input('location') : NULL;
    }
  }

  /**
   * Set current tag as filter item.
   * 
   */
  private function setTag($request)
  {
    if ($request && $request->input('tag'))
    {
      $this->tag = $request->input('tag') !== 'null' ? $request->input('tag') : NULL;
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
      if ($course->hasUpcomingAndPublishedEvents())
      { 
        $event = $course->upcomingAndPublishedEvents->first();
        
        // Get the first upcoming event with a matching expert uuid.
        // The 'upcomingAndPublishedEvents' are sorted by date, so the first 
        // matching event is the closest to todays date.
        if ($expertUuid)
        {
          $filtered = $course->upcomingAndPublishedEvents->filter(function ($value, $key) use ($expertUuid) {
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
          'experts' => $event->experts_fullname_string,
          'fee' => $course->fee,
          'course_fee' => $event->courseFee,
          'online' => $course->online ? TRUE : FALSE,
          'upcoming' => TRUE,
          'teaserImage' => $course->teaserImage
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
          'teaserImage' => $course->teaserImage
        ];
      }
    }
    // return ['courses' => $data, 'filter' => $this->store->get()];
    return ['courses' => $data, 'filter' => NULL];
  }

}