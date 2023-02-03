<?php
use App\Models\User;
use App\Models\Level;

test('admin can create, retrieve, update and destroy a level', function () {

  // Get admin user
  $user = User::admins()->first();
  expect($user)->toBeInstanceOf(User::class);

  // Login user
  Auth::login($user);

  // Get a level from database
  $level = Level::first();
  expect($level)->toBeInstanceOf(Level::class);

  // Use that level to test the endpoint
  $response = $this->get('/api/dashboard/settings/level/' . $level->id);
  expect($response->status())->toBe(200);

  // Get all levels via the endpoint
  $response = $this->get('/api/dashboard/settings/levels');
  expect($response->status())->toBe(200);

  // Create a new level
  $response = $this->post('/api/dashboard/settings/level', [
    'description' => [
      'de' => 'Lorem'
    ],
  ]);

  $levelId = $response->json('levelId');
  expect($levelId)->toBeInt();

  // Update the newly created level
  $response = $this->put('/api/dashboard/settings/level/' . $levelId, [
    'description' => [
      'de' => 'Lorem (update)'
    ],
  ]);

  // Delete the newly created level
  $response = $this->delete('/api/dashboard/settings/level/' . $levelId);
  expect($response->status())->toBe(200);


});