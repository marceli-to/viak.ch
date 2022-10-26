<?php
namespace App\Facades;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Booking;
use App\Models\Job;

class ParticipantsChange
{
  public static function handle(Event $event)
  {
    $bookings = Booking::active()->where('event_id', $event->id)->get();

    if ($bookings)
    {
      // Equal max. participants
      if ($bookings->count() == $event->max_participants)
      {
        Job::create([
          'recipient' => env('MAIL_TO'),
          'mailable_id' => $event->id,
          'mailable_type' => \App\Models\Event::class,
          'mailable_class' => \App\Mail\ParticipantsMax::class
        ]);
      }

      // Equal min. participants
      if ($bookings->count() == $event->min_participants)
      {
        Job::create([
          'recipient' => env('MAIL_TO'),
          'mailable_id' => $event->id,
          'mailable_type' => \App\Models\Event::class,
          'mailable_class' => \App\Mail\ParticipantsMin::class
        ]);
      }
    }

    // Below min participants


  }
}