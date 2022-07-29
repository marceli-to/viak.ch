@extends('web.layout.frontend')
@section('seo_title', __('Experte'))
@section('page_title', __('Experte'))
@section('content')
<section class="container">
  <article class="content-text-media">
    <figure class="text-media__visual">
      @if ($expert->visualImage)
        <x-image :maxSizes="[1000 => 1600, 700 => 1200, 0 => 900]" width="1600" height="900" :image="$expert->visualImage" ratio="16x9" :caption="$expert->fullname" />
      @else
        <img src="/media/viak-placeholder-visual.png" width="1600" height="900" alt="{{ $expert->fullname }}">
      @endif
    </figure>
    <div class="text-media__body">
      <aside>
        @if ($expert->fullname)
          <h1>{{ $expert->fullname }}</h1>
        @endif
        @if ($expert->expert_title)
          <h2>{{ $expert->expert_title }}</h2>
        @endif
      </aside>
      <div>
        @if ($expert->expert_description)
          {!! $expert->expert_description !!}
        @endif
      </div>
    </div>
  </article>
</section>
@if ($courses)
  <section class="container">
    <div class="content-list-item">
      <h2 class="mb-6x md:mb-8x">{{ __('Kurse') }}</h2>
      @foreach($courses as $course)
        <a href="{{ route('page.course', ['slug' => $course->slug, 'course' => $course->uuid]) }}" class="icon-arrow-right:before" title="{{ $course->title }}">
          @include('web.partials.icons.arrow-right')
          <span>{{ $course->title }}</span>
        </a>
      @endforeach
    </div>
  </section>
@endif
@endsection