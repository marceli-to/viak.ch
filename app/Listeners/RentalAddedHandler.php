<?php
namespace App\Listeners;
use App\Events\RentalAdded;
use App\Models\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RentalAddedHandler
{
  /**
   * Handle the event.
   *
   * @param  RentalAdded $rentalAddedEvent
   * @return void
   */
  public function handle(RentalAdded $rentalAddedEvent)
  {

    // Send booking completed email
    Job::create([
      'recipient' => $rentalAddedEvent->user->email,
      'mailable_id' => $rentalAddedEvent->booking->id,
      'mailable_type' => \App\Models\Booking::class,
      'mailable_class' => \App\Mail\RentalAdded::class
    ]);

    // Send info email to admin
    Job::create([
      'recipient' => env('MAIL_TO'),
      'mailable_id' => $rentalAddedEvent->booking->id,
      'mailable_type' => \App\Models\Booking::class,
      'mailable_class' => \App\Mail\RentalAddedInfoAdmin::class
    ]);
  }
}
