@extends('web.layout.frontend')
@section('seo_title', __('Kurse'))
@section('page_title', __('Kurse'))
@section('content')
<section id="app-courses">
  <course-filter>
    @if ($courses)
      <div class="grid-cols-12">
        @foreach($courses as $course)
          <x-course-card :uuid="$course['uuid']" />
        @endforeach
      </div>
    @endif
  </course-filter>
</section>
<script src="{{ mix('assets/js/filter.js') }}" type="text/javascript" defer></script>
@endsection