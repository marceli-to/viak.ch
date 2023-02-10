@extends('web.layout.frontend')
@section('seo_title', __('Home'))
@if ($openGraphImage)
  @section('og_image', url('/') . '/img/cache/' . $openGraphImage->name . '/1500/' . $openGraphImage->coords)
@endif
@section('content')
<section class="container">
  <article class="content-text-media is-reverse">
    @if ($hero)
      @if ($hero->publishedImages && $hero->publishedImages->count() > 1)
        <div class="swiper">
          <div class="swiper-wrapper">
            @foreach($hero->publishedImages as $image)
              <figure class="swiper-slide text-media__visual">
                @if ($image)
                  <x-image :maxSizes="[1000 => 1600, 700 => 1200, 0 => 900]" width="1600" height="900" :image="$image" ratio="16x9" />
                @else
                  <img src="/media/viak-placeholder-visual.png" width="1600" height="900" alt="{{ $image->title }}">
                @endif
              </figure>
            @endforeach
          </div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
        </div>
      @else
        <figure class="text-media__visual">
          @if ($hero->publishedImage)
            <x-image :maxSizes="[1000 => 1600, 700 => 1200, 0 => 900]" width="1600" height="900" :image="$hero->publishedImage" ratio="16x9" />
          @else
            <img src="/media/viak-placeholder-visual.png" width="1600" height="900" alt="">
          @endif
        </figure>
      @endif
    @endif
    <div class="text-media__body">
      <aside>
        <h1>{{ __('Ihre Zukunft ist visuell') }}</h1>
      </aside>
      <div>
        {!! __('<p>Visualisieren ist die Schlüsselkompetenz der Zukunft.<br>Wir machen Sie fit: zum Beispiel in unseren vielseitigen Kursen oder massgeschneiderten Individualschulungen.</p><p>Wir sind führend, wenn es um Visualisierung geht.</p>') !!}        
      </div>
    </div>
  </article>

  @if ($grid)
    @foreach($grid as $row)
      <section class="content-grid content-grid--{{$row->layout}}">
        @foreach($row->items as $item)
        <div>
          @if ($item->course)
            <x-course-card :uuid="$item->uuid" />
          @endif
          @if ($item->news)
            <x-news-card :id="$item->news->id" />
          @endif
          @if ($item->code)
            <x-code-card :item="$item" />
          @endif
        </div>
        @endforeach
      </section>
    @endforeach
  @endif




</section>
@endsection