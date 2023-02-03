<?php
it('can get genders from database', function () {
  $response = $this->get('/api/genders');
  expect($response->status())->toBe(200);
});