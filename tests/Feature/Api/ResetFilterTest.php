<?php

it('can reset a filter', function () {
  $response = $this->delete('/api/course/filter');
  expect($response->status())->toBe(200);
});