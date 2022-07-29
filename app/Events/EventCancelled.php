<?php

namespace App\Events;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Booking;

class EventCancelled
{
  use Dispatchable, SerializesModels;

  public $user;
  public $booking;

  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct(User $user, Booking $booking)
  {
    $booking = Booking::withTrashed()->with('event.course')->find($booking->id);
    $this->user = $user;
    $this->booking = $booking;
  }
}
