<?php
use App\Models\User;
use App\Models\Location;

test('admin can create, retrieve, update and destroy a location', function () {

  // Get admin user
  $user = User::admins()->first();
  expect($user)->toBeInstanceOf(User::class);

  // Login user
  Auth::login($user);

  // Get a location from database
  $location = Location::first();
  expect($location)->toBeInstanceOf(Location::class);

  // Use that location to test the endpoint
  $response = $this->get('/api/dashboard/settings/location/' . $location->id);
  expect($response->status())->toBe(200);

  // Get all locations via the endpoint
  $response = $this->get('/api/dashboard/settings/locations');
  expect($response->status())->toBe(200);

  // Create a new location
  $response = $this->post('/api/dashboard/settings/location', [
    'description' => [
      'de' => 'Lorem'
    ],
    'address' => [
      'de' => 'Ipsum'
    ]
  ]);

  $locationId = $response->json('locationId');
  expect($locationId)->toBeInt();

  // Update the newly created location
  $response = $this->put('/api/dashboard/settings/location/' . $locationId, [
    'description' => [
      'de' => 'Lorem (update)'
    ],
    'address' => [
      'de' => 'Ipsum (update)'
    ]
  ]);

  // Delete the newly created location
  $response = $this->delete('/api/dashboard/settings/location/' . $locationId);
  expect($response->status())->toBe(200);


});