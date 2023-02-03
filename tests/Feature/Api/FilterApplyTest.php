<?php
use App\Models\Category;
use App\Models\Course;
use App\Models\Software;
use App\Models\Language;
use App\Models\Level;
use App\Models\Tag;

it('can apply a filter item', function () {
  $category = Category::first();
  $course = Course::first();
  $software = Software::first();
  $language = Language::first();
  $level = Level::first();
  $tag = Tag::first();

  $response = $this->post('/api/course/filter', [
    'category' => $category->uuid,
    'course' => $course->uuid,
    'software' => $software->uuid,
    'language' => $language->uuid,
    'level' => $level->uuid,
    'tag' => $tag->uuid
  ]);
  
  expect($response->status())->toBe(200);
});