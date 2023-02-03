<?php

test('tests api routes', function ($url) {
  $this->get($url)->assertok();
})->with(['/api/user/settings', '/api/course/filters']);