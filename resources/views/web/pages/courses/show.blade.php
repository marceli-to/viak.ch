@extends('web.layout.frontend')
@section('seo_title', __('Kurse'))
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
        @if ($course->text)
          {!! $course->text !!}
        @endif
        @if ($course->publishedVideos)
          <div class="mt-8x mt-12x">
            @foreach($course->publishedVideos as $video)
              <p>{{ $video->title }}</p>
              <div class="ratio-container mb-8x md:mb-12x">
                {!! $video->code !!}
              </div>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </article>
</section>

<section class="container">

  <x-collapsible title="{{ __('Facts') }}">
    <div class="sm:grid-cols-12">
      <div class="mb-4x sm:mb-0 sm:span-4">
        <h3>Kursinhalt</h3>
        <ul>
          <li>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</li>
          <li>Vamet consectetur adipisicing elit</li>
          <li>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</li>
          <li>Vamet consectetur adipisicing elit</li>
          <li>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</li>
          <li>Vamet consectetur adipisicing elit</li>
        </ul>
      </div>
      <div class="mb-4x sm:mb-0 sm:span-4">
        <h3>Methodik</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, iusto vitae ut voluptas ducimus ad sint alias impedit, eligendi est tenetur explicabo eius.</p>
      </div>
      <div class="mb-4x sm:mb-0 sm:span-4">
        <h3>Abschluss</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis repudiandae aliquam debitis? Fuga recusandae ab eligendi est tenetur explicabo eius.</p>
      </div>
    </div>
  </x-collapsible>
  
  <x-collapsible title="{{ __('Kurse') }}" :expanded="true" id="app-events">
    @if ($course->upcomingEvents->count() > 0)
      @foreach($course->upcomingEvents as $event)
        <x-event-card :event="$event" />
      @endforeach
    @else
      <p class="no-results">Zur Zeit sind keine Kurse geplant.</p>
    @endif
  </x-collapsible>

  <x-collapsible title="{{ __('Weitere Informationen') }}" class="mt-24x">
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis repudiandae aliquam debitis? Exercitationem, iusto vitae ut voluptas ducimus ad sint alias impedit, fuga recusandae ab eligendi est tenetur explicabo eius.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, iusto vitae ut voluptas ducimus ad sint alias impedit, eligendi est tenetur explicabo eius.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis repudiandae aliquam debitis? Fuga recusandae ab eligendi est tenetur explicabo eius.</p>
  </x-collapsible>

  @if ($browse)
    <div class="content-list-item">
      <h2>{{ __('Weitere Kurse') }}</h2>
      <nav class="browse">
        <ul>
          <li>
            <a href="{{ route('page.course', ['slug' => $browse['prev']->slug, 'course' => $browse['prev']->uuid]) }}" title="{{ $browse['prev']->title }}">
              <span>{{ $browse['prev']->title }}</span>
              @include('web.partials.icons.arrow-left')
            </a>
          </li>
          <li>
            <a href="{{ route('page.course', ['slug' => $browse['next']->slug, 'course' => $browse['next']->uuid]) }}" title="{{ $browse['next']->title }}">
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
