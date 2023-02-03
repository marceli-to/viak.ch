<?php
use App\Models\User;
use App\Models\Hero;

test('admin can create, retrieve, update and destroy a hero', function () {

  // Get admin user
  $user = User::admins()->first();
  expect($user)->toBeInstanceOf(User::class);

  // Login user
  Auth::login($user);

  // Get a hero from database
  $hero = Hero::first();
  expect($hero)->toBeInstanceOf(Hero::class);

  // Use that hero to test the endpoint
  $response = $this->get('/api/dashboard/hero/' . $hero->id);
  expect($response->status())->toBe(200);

  // Get all heroes via the endpoint
  $response = $this->get('/api/dashboard/heroes');
  expect($response->status())->toBe(200);

  // Create a new hero
  $response = $this->post('/api/dashboard/hero', [
    'title' => 'Lorem',
  ]);

  $heroId = $response->json('heroId');
  expect($heroId)->toBeInt();

  // Update the newly created hero
  $response = $this->put('/api/dashboard/hero/' . $heroId, [
    'title' => 'Lorem',
  ]);

  // Delete the newly created hero
  $response = $this->delete('/api/dashboard/hero/' . $heroId);
  expect($response->status())->toBe(200);
});