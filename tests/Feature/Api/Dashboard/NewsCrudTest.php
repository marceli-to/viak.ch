<?php
use App\Models\User;
use App\Models\News;

test('admin can create, retrieve, update and destroy a news', function () {

  // Get admin user
  $user = User::admins()->first();
  expect($user)->toBeInstanceOf(User::class);

  // Login user
  Auth::login($user);

  // Get a news from database
  $news = News::first();
  expect($news)->toBeInstanceOf(News::class);

  // Use that news to test the endpoint
  $response = $this->get('/api/dashboard/news/' . $news->id);
  expect($response->status())->toBe(200);

  // Get all newses via the endpoint
  $response = $this->get('/api/dashboard/news-items');
  expect($response->status())->toBe(200);

  // Create a new news
  $response = $this->post('/api/dashboard/news', [
    'title' => 'Lorem',
  ]);

  $newsId = $response->json('newsId');
  expect($newsId)->toBeInt();

  // Update the newly created news
  $response = $this->put('/api/dashboard/news/' . $newsId, [
    'title' => 'Lorem',
  ]);

  // Delete the newly created news
  $response = $this->delete('/api/dashboard/news/' . $newsId);
  expect($response->status())->toBe(200);
});