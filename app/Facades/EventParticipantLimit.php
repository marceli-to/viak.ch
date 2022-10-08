<?php
namespace App\Facades;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Booking;
use App\Models\Job;

class EventParticipantLimit
{
  public function handle(Event $event)
  {
    $bookings = Booking::where('event_id', $event->id)->get();
    if ($bookings && $bookings->count() > $event->max_participants)
    {
      Job::create([
        'recipient' => env('MAIL_TO'),
        'mailable_id' => $event->id,
        'mailable_type' => \App\Models\Event::class,
        'mailable_class' => \App\Mail\EventParticipantLimitReached::class
      ]);
    }
  }
}