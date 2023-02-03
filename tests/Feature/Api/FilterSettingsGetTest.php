<?php

it('can get course filter settings from database', function () {
  $response = $this->get('/api/course/filters');
  expect($response->status())->toBe(200);
});