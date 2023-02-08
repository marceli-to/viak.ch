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
        <h1>Individualschulungen für Firmen und Einzelpersonen</h1>
      </aside>
      <div>
        <p>Die effizienteste Möglichkeit, weiterzukommen. Nehmen Sie die Gelegenheit wahr, die Besten ihres Fachs exklusiv zu buchen. Und erleben Sie, wie Ihre Fähigkeiten Riesenschritte in Richtung Ziel machen!
        <p>Unsere Individualschulungen, die wir ganz nach Ihren Wünschen massschneidern, sind echtes Personal Training. Das fühlt sich gut an, auch für uns. Gemeinsam vorwärts zu gehen – im Tempo ganz auf Sie zugeschnitten – ist ein erfüllendes Erlebnis.
        <p>Was ist Ihr Thema?<br>Bestimmt finden wir in unserem einzigartigen Netzwerk den genau für Sie idealen Coach.</p>
        <p>Ob Sie nun als Architekturbüro mehrere Mitarbeiter:innen in der hohen Kunst der Architekturvisualisierung schulen möchten, als Freelancer:in eine Schnittsoftware wie DaVinci Resolve lernen wollen, als Produktdesigner:in endlich Ihr Wissen in Rhinoceros vertiefen möchten, sich als Einzelperson oder Firma mit 3D-Druck oder 3D-Scan auseinandersetzen wollen: Sie brauchen sich nur noch bei uns zu melden.</p>
        <p>Mit Freude stellen wir Ihnen eine auf Ihre Ziele und Wünsche ausgerichtete Individualschulung zusammen.</p>
        <p>Wir freuen uns auf Ihre Nachricht oder Ihren Anruf.</p>
        <p><a href="{{ localized_route('page.contact') }}" title="{{ __('Kontakt') }}">Wir freuen uns auf Ihre Anfrage.</a></p>
      </div>
    </div>
  </article>
</section>

@endsection