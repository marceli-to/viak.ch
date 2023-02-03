<?php

test('tests web routes', function ($url) {
  $this->get($url)->assertok();
})->with(
  [
    '/de/kontakt',
    '/de/kurse',
    '/de/experten',
    '/login',
    '/de/registration',
    'password/reset',
  ]
);