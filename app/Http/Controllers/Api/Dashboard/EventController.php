<?php
namespace App\Http\Controllers\Api\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Http\Resources\Dashboard\EventCollection;
use App\Models\Course;
use App\Models\Event;
use App\Models\EventDate;
use App\Events\EventConfirmed;
use App\Events\EventCancelled;
use App\Events\EventClosed;
use App\Http\Requests\EventStoreRequest;
use Illuminate\Http\Request;

class EventController extends Controller
{

  /**
   * Get a list of events
   * 
   * @param Course $course
   * @return \Illuminate\Http\Response
   */
  public function get(Course $course)
  {
    $data = [
      'course' => $course,
      'upcoming' => new EventCollection(
        Event::upcoming()
        ->active()
        ->with('dates', 'experts', 'location', 'course', 'bookings')
        ->where('course_id', $course->id)->get()
      ),
      'past' => new EventCollection(
        Event::past()
        ->active()
        ->with('dates', 'experts', 'location', 'course', 'bookings')
        ->where('course_id', $course->id)
        ->get()
      ),
      'cancelled' => new EventCollection(
        Event::cancelled()
        ->with('dates', 'experts', 'location', 'course', 'bookings')
        ->where('course_id', $course->id)
        ->get()
      ),
    ];

    return response()->json($data);
  }

  /**
   * Get a single event
   * 
   * @param Event $event
   * @return \Illuminate\Http\Response
   */
  public function find(Event $event)
  {
    $event = Event::with('dates', 'experts', 'location', 'course', 'bookings')->find($event->id);
    return response()->json($event);
  }

  /**
   * Store a newly created event
   *
   * @param  \Illuminate\Http\EventStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(EventStoreRequest $request)
  {
    // Create 'event'
    $event = Event::create(
      array_merge(
        $request->all(), 
        ['uuid' => \Str::uuid()]
      )
    );

    // Add expers
    $event->experts()->attach($request->input('expert_ids'));

    // Set the 'main' date from the dates array
    $dates = collect($request->input('dates'));
    $event->date = $dates->min('date_short');
    $event->save();

    foreach($request->input('dates') as $date)
    {
      EventDate::create([
        'event_id' => $event->id,
        'date' => $date['date_short'],
        'time_start' => $date['time_start'],
        'time_end' => $date['time_end'],
      ]);
    }
    return response()->json(['eventId' => $event->id]);
  }

  /**
   * Update a event for a given event
   *
   * @param Event $event
   * @param  \Illuminate\Http\EventStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function update(Event $event, EventStoreRequest $request)
  {
    $event = Event::findOrFail($event->id);
    $event->update($request->except(['date', 'dates']));

    // Sync experts
    $event->experts()->sync($request->input('expert_ids'));

    // Delete current dates
    $event->dates()->delete();

    // Set the new 'main' date from the dates array
    $dates = collect($request->input('dates'));
    $event->date = $dates->min('date_short');
    $event->save();

    foreach($request->input('dates') as $date)
    {
      EventDate::create([
        'event_id' => $event->id,
        'date' => $date['date_short'],
        'time_start' => $date['time_start'],
        'time_end' => $date['time_end'],
      ]);
    }
   
    return response()->json('successfully updated');
  }

  /**
   * Toggle the status a given event
   *
   * @param  Event $event
   * @return \Illuminate\Http\Response
   */
  public function toggle(Event $event)
  {
    $event->publish = $event->publish == 0 ? 1 : 0;
    $event->save();
    return response()->json($event->publish);
  }

  /**
   * Confirm an event
   *
   * @param  Event $event
   * @return \Illuminate\Http\Response
   */
  public function confirm(Event $event)
  {
    if ($event->confirmed == 1)
    {
      return response()->json('successfully updated');
    }
    
    // Update event
    $event->confirmed = 1;
    $event->confirmed_at = \Carbon\Carbon::now();
    $event->save();

    event(new EventConfirmed($event));
    return response()->json('successfully updated');
  }

  /**
   * Cancel an event
   *
   * @param  Event $event
   * @return \Illuminate\Http\Response
   */
  public function cancel(Event $event)
  {
    if ($event->cancelled == 1)
    {
      return response()->json('successfully updated');
    }
    event(new EventCancelled($event));
    return response()->json('successfully updated');
  }

  /**
   * Close an event
   *
   * @param  Event $event
   * @return \Illuminate\Http\Response
   */
  public function close(Event $event)
  {
    if ($event->closed == 1)
    {
      return response()->json('successfully updated');
    }
    
    // Update event
    $event->closed = 1;
    $event->closed_at = \Carbon\Carbon::now();
    $event->save();

    event(new EventClosed($event));
    return response()->json('successfully updated');
  }

  /**
   * Remove a event
   *
   * @param  Event $event
   * @return \Illuminate\Http\Response
   */
  public function destroy(Event $event)
  {
    $event->experts()->detach();
    $event->delete();
    return response()->json('successfully deleted');
  }
}
