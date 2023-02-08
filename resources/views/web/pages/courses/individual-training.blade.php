@extends('web.layout.frontend')
@section('seo_title', __('Individualschulungen'))
@section('page_title', __('Individualschulungen'))
@section('content')
@php
$slides = [
  'viak-individualschulung-1.jpg',
  'viak-individualschulung-2.jpg',
  'viak-individualschulung-3.jpg',
  'viak-individualschulung-4.jpg',
  'viak-individualschulung-5.jpg',
  'viak-individualschulung-6.jpg',
];
@endphp
<section class="container">
  <article class="content-text-media">
    <div class="swiper">
      <div class="swiper-wrapper">
        @foreach($slides as $image)
          <figure class="swiper-slide text-media__visual">
            <img src="/media/{{ $image }}" width="1600" height="900" alt="{{ __('Individualschulungen') }}">
          </figure>
        @endforeach
      </div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>


    <div class="text-media__body">
      <aside>

      </aside>
      <div>

      </div>
    </div>
  </article>
</section>

@endsection