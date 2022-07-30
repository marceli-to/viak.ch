<?php
namespace App\Http\Controllers\Api\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Http\Resources\Dashboard\CourseCollection;
use App\Models\Course;
use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseUpdateRequest;
use Illuminate\Http\Request;

class CourseController extends Controller
{
  /**
   * Get a list of courses
   * 
   * @param String $constraint
   * @return \Illuminate\Http\Response
   */
  public function get($constraint = NULL)
  {
    if ($constraint == 'publish')
    {
      return new DataCollection(Course::published()->orderBy('number', 'ASC')->get());
    }
    return new CourseCollection(Course::with('upcomingEvents.experts', 'upcomingEvents.dates', 'upcomingEvents.location', 'upcomingEvents.course', 'categories')->orderBy('number', 'ASC')->get());
  }

  /**
   * Get a single course
   * 
   * @param Course $course
   * @return \Illuminate\Http\Response
   */
  public function find(Course $course)
  {
    $course = Course::with('images')->find($course->id);
    return response()->json($course);
  }

  /**
   * Store a newly created course
   *
   * @param  \Illuminate\Http\CourseStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(CourseStoreRequest $request)
  {
    // Create 'course'
    $course = Course::create(
      array_merge(
        $request->all(), 
        ['uuid' => \Str::uuid()]
      )
    );
    $course->save();
    $course->setTranslation('slug', 'de', \Str::slug($request->input('title.de')));
    $course->setTranslation('slug', 'en', \Str::slug($request->input('title.de')));
    $course->categories()->attach($request->input('category_ids'));
    $course->languages()->attach($request->input('language_ids'));
    $course->levels()->attach($request->input('level_ids'));
    $course->softwares()->attach($request->input('software_ids'));
    $course->tags()->attach($request->input('tag_ids'));
    return response()->json(['courseId' => $course->id]);
  }

  /**
   * Update a course for a given course
   *
   * @param Course $course
   * @param  \Illuminate\Http\CourseUpdateRequest $request
   * @return \Illuminate\Http\Response
   */
  public function update(Course $course, CourseUpdateRequest $request)
  {
    $course = Course::findOrFail($course->id);
    $course->setTranslation('slug', 'de', \Str::slug($request->input('title.de')));
    $course->setTranslation('slug', 'en', \Str::slug($request->input('title.de')));
    $course->update($request->all());
    $course->categories()->sync($request->input('category_ids'));
    $course->languages()->sync($request->input('language_ids'));
    $course->levels()->sync($request->input('level_ids'));
    $course->softwares()->sync($request->input('software_ids'));
    $course->tags()->sync($request->input('tag_ids'));
    $course->save();
    return response()->json('successfully updated');
  }

  /**
   * Toggle the status a given course
   *
   * @param  Course $course
   * @return \Illuminate\Http\Response
   */
  public function toggle(Course $course)
  {
    $course->publish = $course->publish == 0 ? 1 : 0;
    $course->save();
    return response()->json($course->publish);
  }

  /**
   * Remove a course
   *
   * @param  Course $course
   * @return \Illuminate\Http\Response
   */
  public function destroy(Course $course)
  {
    $course->delete();
    foreach($course->events as $event)
    {
      $event->experts()->detach();
      $event->delete();
    }
    return response()->json('successfully deleted');
  }
}
