@extends('web.layout.frontend')
@section('seo_title', $course->title)
@section('seo_description', $course->seo_description ? $course->seo_description : '')
@section('seo_keywords', $course->seo_tags ? $course->seo_tags : '')
@if ($course->openGraphImage)
  @section('og_image', url('/') . '/img/cache/' . $course->openGraphImage->name .'/1500/'. $course->openGraphImage->coords)
@endif
@section('page_title', __('Kurse'))
@section('content')
<section class="container">
  <article class="content-text-media">
    @if ($course->visualImages->count() > 1)
      <div class="swiper">
        <div class="swiper-wrapper">
          @foreach($course->visualImages as $image)
            <figure class="swiper-slide text-media__visual">
              @if ($image)
                <x-image :maxSizes="[1000 => 1600, 700 => 1200, 0 => 900]" width="1600" height="900" :image="$image" ratio="16x9" :caption="$course->title" />
              @else
                <img src="/media/viak-placeholder-visual.png" width="1600" height="900" alt="{{ $course->title }}">
              @endif
            </figure>
          @endforeach
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>
    @else
      <figure class="text-media__visual">
        @if ($course->visualImage)
          <x-image :maxSizes="[1000 => 1600, 700 => 1200, 0 => 900]" width="1600" height="900" :image="$course->visualImage" ratio="16x9" :caption="$course->title" />
        @else
          <img src="/media/viak-placeholder-visual.png" width="1600" height="900" alt="{{ $course->title }}">
        @endif
      </figure>
    @endif
     <div class="text-media__body">
      <aside>
        @if ($course->title)
          <h1>{{ $course->title }}</h1>
        @endif
        @if ($course->subtitle)
          <h2>{{ $course->subtitle }}</h2>
        @endif
      </aside>
      <div>
        @if ($course->short_description)
          {!! $course->short_description !!}
        @endif
      </div>
    </div>
  </article>
</section>

<section class="container container-course">

  <x-collapsible title="{{ __('Aktuelle Kurse') }}" :expanded="true" id="app-events">
    @if ($course->upcomingAndPublishedEvents->count() > 0)
      @foreach($course->upcomingAndPublishedEvents as $event)
        <x-event-card :event="$event" />
      @endforeach
    @else
      <p class="no-results">Zur Zeit sind keine Kurse geplant.</p>
    @endif
  </x-collapsible>

  @if ($course->publishedVideos)
    <x-collapsible title="{{ __('Videos') }}">
      @foreach($course->publishedVideos as $video)
        <x-card-text class="card-video">
          <x-slot name="aside">
            {{ $video->title }}
          </x-slot>
          <x-slot name="content">
            <div class="ratio-container">
              {!! $video->code !!}
            </div>
          </x-slot>
        </x-card-text>
      @endforeach
    </x-collapsible>
  @endif

  @if ($course->facts_column_1 || $course->facts_column_2 || $course->facts_column_3)
    <x-collapsible title="{{ __('Facts') }}">
      <div class="sm:grid-cols-12">
        @if ($course->facts_column_1)
          <div class="mb-4x sm:mb-0 sm:span-4 text-item">
            {!! $course->facts_column_1 !!}
          </div>
        @endif
        @if ($course->facts_column_2)
          <div class="mb-4x sm:mb-0 sm:span-4 text-item">
            {!! $course->facts_column_2 !!}
          </div>
        @endif
        @if ($course->facts_column_3)
          <div class="mb-4x sm:mb-0 sm:span-4 text-item">
            {!! $course->facts_column_3 !!}
          </div>
        @endif
      </div>
    </x-collapsible>
  @endif
  
  @if ($course->full_description)
    <x-collapsible title="{{ __('Detailbeschrieb') }}">
      <div class="sm:grid-cols-12">
        <div class="span-8">
          {!! $course->full_description !!}
        </div>
      </div>
    </x-collapsible>
  @endif

  @if ($course->additional_information || $course->reviews)
    <x-collapsible title="{{ __('Weitere Informationen') }}">
      <div class="sm:grid-cols-12">
        @if ($course->additional_information)
          <div class="mb-4x sm:mb-0 sm:span-4 text-item">
            {!! $course->additional_information !!}
          </div>
        @endif
        <div class="mb-4x sm:mb-0 sm:span-4">
        </div>
        @if ($course->reviews)
          <div class="mb-4x sm:mb-0 sm:span-4">
            {!! $course->reviews !!}
          </div>
        @endif
      </div>
    </x-collapsible>
  @endif

  @if ($browse)
    <div class="content-list-item">
      <h2>{{ __('Weitere Kurse') }}</h2>
      <nav class="browse">
        <ul>
          <li>
            <a href="{{ localized_route('page.course', ['slug' => $browse['prev']->slug, 'course' => $browse['prev']->uuid]) }}" title="{{ $browse['prev']->title }}">
              <span>{{ $browse['prev']->title }}</span>
              @include('web.partials.icons.arrow-left')
            </a>
          </li>
          <li>
            <a href="{{ localized_route('page.course', ['slug' => $browse['next']->slug, 'course' => $browse['next']->uuid]) }}" title="{{ $browse['next']->title }}">
              <span>{{ $browse['next']->title }}</span>
              @include('web.partials.icons.arrow-right')
            </a>
          </li>
        </ul>
      </nav>
    </div>
  @endif
</section>
<script src="{{ mix('assets/js/global/app.js') }}" type="text/javascript"></script>
@endsection
