<?php

namespace App\Events;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Event;

class EventConfirmed
{
  use Dispatchable, SerializesModels;

  public $event;

  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct(Event $event)
  { 
    $this->event = Event::with('course')->find($event->id);;
  }
}
