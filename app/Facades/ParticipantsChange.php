<?php
namespace App\Facades;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Booking;
use App\Models\Job;
use App\Mail\ParticipantsBelowMin;
use App\Mail\ParticipantsMin;
use App\Mail\ParticipantsMax;

class ParticipantsChange
{
  public static function handle(Event $event, $bookingCancelled = FALSE)
  {
    $bookingsCount     = Booking::active()->where('event_id', $event->id)->get()->count();
    $equalsMax         = $event->max_participants;
    $equalsMin         = $event->min_participants;
    $equalsOneBelowMin = $event->min_participants - 1;

    if ($bookingsCount > 0)
    {
      // Handling booking cancelling first
      if ($bookingCancelled)
      {
        if ($bookingsCount == $equalsOneBelowMin)
        // Below min participants
        Job::create([
          'recipient' => env('MAIL_TO'),
          'mailable_id' => $event->id,
          'mailable_type' => Event::class,
          'mailable_class' => ParticipantsBelowMin::class
        ]);
      }
      else
      {
        // Equal max. participants
        if ($bookingsCount == $equalsMax)
        {
          Job::create([
            'recipient' => env('MAIL_TO'),
            'mailable_id' => $event->id,
            'mailable_type' => Event::class,
            'mailable_class' => ParticipantsMax::class
          ]);
        }

        // Equal min. participants
        if ($bookingsCount == $equalsMin)
        {
          Job::create([
            'recipient' => env('MAIL_TO'),
            'mailable_id' => $event->id,
            'mailable_type' => Event::class,
            'mailable_class' => ParticipantsMin::class,
          ]);
        }
      }
    }
  }
}