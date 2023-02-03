<?php
use App\Models\User;
use App\Models\Tag;

test('admin can create, retrieve, update and destroy a tag', function () {

  // Get admin user
  $user = User::admins()->first();
  expect($user)->toBeInstanceOf(User::class);

  // Login user
  Auth::login($user);

  // Get a tag from database
  $tag = Tag::first();
  expect($tag)->toBeInstanceOf(Tag::class);

  // Use that tag to test the endpoint
  $response = $this->get('/api/dashboard/settings/tag/' . $tag->id);
  expect($response->status())->toBe(200);

  // Get all tags via the endpoint
  $response = $this->get('/api/dashboard/settings/tags');
  expect($response->status())->toBe(200);

  // Create a new tag
  $response = $this->post('/api/dashboard/settings/tag', [
    'description' => [
      'de' => 'Lorem'
    ],
  ]);

  $tagId = $response->json('tagId');
  expect($tagId)->toBeInt();

  // Update the newly created tag
  $response = $this->put('/api/dashboard/settings/tag/' . $tagId, [
    'description' => [
      'de' => 'Lorem (update)'
    ],
  ]);

  // Delete the newly created tag
  $response = $this->delete('/api/dashboard/settings/tag/' . $tagId);
  expect($response->status())->toBe(200);


});