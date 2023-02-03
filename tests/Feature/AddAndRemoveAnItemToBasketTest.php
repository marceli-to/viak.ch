<?php
use App\Models\Event;

it('can add an item to the basket and remove it', function () {

  $event = Event::first();
  expect($event)->toBeInstanceOf(Event::class);

  $response = $this->put('/api/basket/' . $event->uuid);
  expect($response->status())->toBe(200);

  $response = $this->delete('/api/basket/' . $event->uuid);
  expect($response->status())->toBe(200);

});