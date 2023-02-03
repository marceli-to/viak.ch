<?php
it('can get translations from disk', function () {
  $response = $this->get('/api/translations/de');
  expect($response->status())->toBe(200);
});