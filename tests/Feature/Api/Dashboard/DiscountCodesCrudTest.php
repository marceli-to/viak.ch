<?php
use App\Models\User;
use App\Models\DiscountCode;

test('admin can create, retrieve, update and destroy a discount code', function () {

  // Get admin user
  $user = User::admins()->first();
  expect($user)->toBeInstanceOf(User::class);

  // Login user
  Auth::login($user);

  // Create a discount code
  $response = $this->get('/api/dashboard/discount-code/create');
  expect($response->status())->toBe(200);

  // Get all discount codes via the endpoint
  $response = $this->get('/api/dashboard/discount-codes');
  expect($response->status())->toBe(200);

  // Get a news from database
  $discountCode = DiscountCode::first();
  expect($discountCode)->toBeInstanceOf(DiscountCode::class);

  // Create a new discount code
  $response = $this->get('/api/dashboard/discount-code/create');

  // Store the new discount code
  $response = $this->post('/api/dashboard/discount-code', [
    'code' => $response->getData(),
    'amount' => '10',
    'fix' => 0,
    'percent' => 1,
    'valid_from' => null,
    'valid_to' => null,
  ]);
  $discountCodeId = $response->json('discountCodeId');
  expect($discountCodeId)->toBeInt();

  // Use that discount code to test the endpoint
  $response = $this->get('/api/dashboard/discount-code/' . $discountCodeId);
  expect($response->status())->toBe(200);

  // Update the newly created discount code
  $response = $this->put('/api/dashboard/discount-code/' . $discountCodeId, [
    'code' => $response->json('code'),
    'amount' => '20',
  ]);
  expect($response->status())->toBe(200);

  // Delete the newly created news
  $response = $this->delete('/api/dashboard/discount-code/' . $discountCodeId);
  expect($response->status())->toBe(200);
  
});