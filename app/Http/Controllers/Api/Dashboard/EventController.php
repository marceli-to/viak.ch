<?php
namespace App\Http\Controllers\Api\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Http\Requests\EventStoreRequest;
use Illuminate\Http\Request;

class EventController extends Controller
{

  /**
   * Get a list of events
   * 
   * @param String $constraint
   * @return \Illuminate\Http\Response
   */
  public function get($constraint = NULL)
  {
    if ($constraint == 'publish')
    {
      return new DataCollection(Event::published()->orderBy('date', 'ASC')->get());
    }
    return new DataCollection(Event::orderBy('date', 'ASC')->get());
  }

  /**
   * Get a single event
   * 
   * @param Event $event
   * @return \Illuminate\Http\Response
   */
  public function find(Event $event)
  {
    $event = Event::with('dates', 'experts', 'location', 'course')->find($event->id);
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
    $event = Event::create($request->all());
    $event->save();
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
    $event->update($request->all());
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
   * Remove a event
   *
   * @param  Event $event
   * @return \Illuminate\Http\Response
   */
  public function destroy(Event $event)
  {
    $event->delete();
    return response()->json('successfully deleted');
  }
}
