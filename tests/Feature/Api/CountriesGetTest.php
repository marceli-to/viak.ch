<?php
it('can get countries from database', function () {
  $response = $this->get('/api/countries');
  expect($response->status())->toBe(200);
});