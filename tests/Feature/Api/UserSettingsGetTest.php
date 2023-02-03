<?php
it('can get a user settings from database', function () {
  $response = $this->get('/api/user/settings');
  expect($response->status())->toBe(200);
});