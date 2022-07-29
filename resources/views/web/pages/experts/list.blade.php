@extends('web.layout.frontend')
@section('seo_title', __('Experten'))
@section('page_title', __('Experten'))
@section('content')
<section id="app-courses">
  <course-filter>
    @if ($experts)
      <div class="grid-cols-12">
        @foreach($experts as $expert)
          <x-expert-card :user="$expert" />
        @endforeach
      </div>
    @endif
  </course-filter>
</section>
@endsection