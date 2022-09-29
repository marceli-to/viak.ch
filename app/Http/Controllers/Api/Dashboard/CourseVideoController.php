<?php
namespace App\Http\Controllers\Api\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Models\Course;
use App\Models\CourseVideo;
use App\Http\Requests\CourseVideoStoreRequest;
use Illuminate\Http\Request;

class CourseVideoController extends Controller
{
  /**
   * Get a list of course videos
   * 
   * @param Course $course
   * @return \Illuminate\Http\Response
   */
  public function get(Course $course)
  {
    return new DataCollection(CourseVideo::orderBy('order')->where('course_id', $course->id)->get());
  }

  /**
   * Get a single courseVideo
   * 
   * @param CourseVideo $courseVideo
   * @return \Illuminate\Http\Response
   */
  public function find(CourseVideo $courseVideo)
  {
    $courseVideo = CourseVideo::with('images')->find($courseVideo->id);
    return response()->json($courseVideo);
  }

  /**
   * Store a newly created courseVideo
   *
   * @param  \Illuminate\Http\CourseVideoStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(CourseVideoStoreRequest $request)
  {
    // Create 'courseVideo'
    $courseVideo = CourseVideo::create(
      array_merge(
        $request->all(), 
        ['uuid' => \Str::uuid()]
      )
    );
    $courseVideo->save();
    return response()->json(['courseVideoId' => $courseVideo->id]);
  }

  /**
   * Update a courseVideo for a given courseVideo
   *
   * @param CourseVideo $courseVideo
   * @param  \Illuminate\Http\CourseVideoStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function update(CourseVideo $courseVideo, CourseVideoStoreRequest $request)
  {
    $courseVideo = CourseVideo::findOrFail($courseVideo->id);
    return response()->json('successfully updated');
  }

  /**
   * Toggle the status a given courseVideo
   *
   * @param  CourseVideo $courseVideo
   * @return \Illuminate\Http\Response
   */
  public function toggle(CourseVideo $courseVideo)
  {
    $courseVideo->publish = $courseVideo->publish == 0 ? 1 : 0;
    $courseVideo->save();
    return response()->json($courseVideo->publish);
  }

  /**
   * Update the order the course videos
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function order(Request $request)
  {
    $courseVideos = $request->get('courseVideos');
    foreach($courseVideos as $courseVideo)
    {
      $i = CourseVideo::find($courseVideo['id']);
      $i->order = $courseVideo['order'];
      $i->save(); 
    }
    return response()->json('successfully updated');
  }

  /**
   * Remove a courseVideo
   *
   * @param  CourseVideo $courseVideo
   * @return \Illuminate\Http\Response
   */
  public function destroy(CourseVideo $courseVideo)
  {
    $courseVideo->delete();
    return response()->json('successfully deleted');
  }
}
