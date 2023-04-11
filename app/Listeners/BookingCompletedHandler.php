<?php
namespace App\Listeners;
use App\Events\BookingCompleted;
use App\Models\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BookingCompletedHandler
{
  /**
   * Handle the event.
   *
   * @param  BookingCompleted $bookingCompletedEvent
   * @return void
   */
  public function handle(BookingCompleted $bookingCompletedEvent)
  {

    // Send booking completed email
    Job::create([
      'recipient' => $bookingCompletedEvent->user->email,
      'mailable_id' => $bookingCompletedEvent->booking->id,
      'mailable_type' => \App\Models\Booking::class,
      'mailable_class' => \App\Mail\BookingCompleted::class
    ]);

    // Send info email to experts
    foreach($bookingCompletedEvent->booking->event->experts as $expert)
    {
      Job::create([
        'recipient' => $expert->email,
        'mailable_id' => $bookingCompletedEvent->booking->event->id,
        'mailable_type' => \App\Models\Event::class,
        'mailable_class' => \App\Mail\BookingCreatedInfoExpert::class
      ]);
    }

    // Send info email to admin
    Job::create([
      'recipient' => env('MAIL_TO'),
      'mailable_id' => $bookingCompletedEvent->booking->event->id,
      'mailable_type' => \App\Models\Event::class,
      'mailable_class' => \App\Mail\BookingCreatedInfoAdmin::class
    ]);

    // Send event confirmed email
    if ($bookingCompletedEvent->booking->event->hasFlag('isConfirmed'))
    {
      Job::create([
        'recipient' => $bookingCompletedEvent->user->email,
        'mailable_id' => $bookingCompletedEvent->booking->id,
        'mailable_type' => \App\Models\Booking::class,
        'mailable_class' => \App\Mail\EventConfirmationStudent::class
      ]);
    }
  }
}
