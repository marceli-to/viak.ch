<?php
use App\Models\User;
use App\Models\Category;

test('admin can create, retrieve, update and destroy a category', function () {

  // Get admin user
  $user = User::admins()->first();
  expect($user)->toBeInstanceOf(User::class);

  // Login user
  Auth::login($user);

  // Get a category from database
  $category = Category::first();
  expect($category)->toBeInstanceOf(Category::class);

  // Use that category to test the endpoint
  $response = $this->get('/api/dashboard/settings/category/' . $category->id);
  expect($response->status())->toBe(200);

  // Get all categories via the endpoint
  $response = $this->get('/api/dashboard/settings/categories');
  expect($response->status())->toBe(200);

  // Create a new category
  $response = $this->post('/api/dashboard/settings/category', [
    'description' => [
      'de' => 'Lorem'
    ],
  ]);

  $categoryId = $response->json('categoryId');
  expect($categoryId)->toBeInt();

  // Update the newly created category
  $response = $this->put('/api/dashboard/settings/category/' . $categoryId, [
    'description' => [
      'de' => 'Lorem (update)'
    ],
  ]);

  // Delete the newly created category
  $response = $this->delete('/api/dashboard/settings/category/' . $categoryId);
  expect($response->status())->toBe(200);


});