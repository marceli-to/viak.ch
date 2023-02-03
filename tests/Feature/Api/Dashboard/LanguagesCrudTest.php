<?php
use App\Models\User;
use App\Models\Language;

test('admin can create, retrieve, update and destroy a language', function () {

  // Get admin user
  $user = User::admins()->first();
  expect($user)->toBeInstanceOf(User::class);

  // Login user
  Auth::login($user);

  // Get a language from database
  $language = Language::first();
  expect($language)->toBeInstanceOf(Language::class);

  // Use that language to test the endpoint
  $response = $this->get('/api/dashboard/settings/language/' . $language->id);
  expect($response->status())->toBe(200);

  // Get all languages via the endpoint
  $response = $this->get('/api/dashboard/settings/languages');
  expect($response->status())->toBe(200);

  // Create a new language
  $response = $this->post('/api/dashboard/settings/language', [
    'description' => [
      'de' => 'Lorem'
    ],
  ]);

  $languageId = $response->json('languageId');
  expect($languageId)->toBeInt();

  // Update the newly created language
  $response = $this->put('/api/dashboard/settings/language/' . $languageId, [
    'description' => [
      'de' => 'Lorem (update)'
    ],
  ]);

  // Delete the newly created language
  $response = $this->delete('/api/dashboard/settings/language/' . $languageId);
  expect($response->status())->toBe(200);


});