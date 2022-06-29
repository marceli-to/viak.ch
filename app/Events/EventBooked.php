<?php

namespace App\Events;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Event;

class EventBooked
{
  use Dispatchable, SerializesModels;

  public $user;
  public $event;

  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct(User $user, Event $event)
  {
    $this->user = $user;
    $this->event = $event;
  }
}
