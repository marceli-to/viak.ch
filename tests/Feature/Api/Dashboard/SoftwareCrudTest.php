<?php
use App\Models\User;
use App\Models\Software;

test('admin can create, retrieve, update and destroy a software', function () {

  // Get admin user
  $user = User::admins()->first();
  expect($user)->toBeInstanceOf(User::class);

  // Login user
  Auth::login($user);

  // Get a software from database
  $software = Software::first();
  expect($software)->toBeInstanceOf(Software::class);

  // Use that software to test the endpoint
  $response = $this->get('/api/dashboard/settings/software/' . $software->id);
  expect($response->status())->toBe(200);

  // Get all softwares via the endpoint
  $response = $this->get('/api/dashboard/settings/softwares');
  expect($response->status())->toBe(200);

  // Create a new software
  $response = $this->post('/api/dashboard/settings/software', [
    'description' => [
      'de' => 'Lorem'
    ],
  ]);

  $softwareId = $response->json('softwareId');
  expect($softwareId)->toBeInt();

  // Update the newly created software
  $response = $this->put('/api/dashboard/settings/software/' . $softwareId, [
    'description' => [
      'de' => 'Lorem (update)'
    ],
  ]);

  // Delete the newly created software
  $response = $this->delete('/api/dashboard/settings/software/' . $softwareId);
  expect($response->status())->toBe(200);


});