@extends('web.layout.frontend')
@section('seo_title', __('Home'))
@section('content')
<section class="container">
  <article class="content-text-media is-reverse">
    <figure class="text-media__visual">
      <img src="/media/viak-keyvisual-home.jpg" width="1600" height="1000" alt="Ihre Zukunft ist visuell">
      {{-- @if ($expert->visualImage)
        <x-image :maxSizes="[0 => 700, 700 => 1100]" width="600" height="600" image="viak-keyvisual-home.jpg" ratio="16x9" caption="Ihre Zukunft ist visuell" />
      @else
        <img src="/media/viak-keyvisual-home.jpg" width="1600" height="1000" alt="Ihre Zukunft ist visuell">
      @endif --}}
    </figure>
    <div class="text-media__body">
      <aside>
        <h1>{{ __('Ihre Zukunft ist visuell') }}</h1>
      </aside>
      <div>
        {!! __('<p>Visualisieren ist die Schlüsselkompetenz der Zukunft. Wir machen Dich fit: zum Beispiel in unseren vielseitigen Kursen oder massgeschneiderten Individualschulungen.</p><p>Wir sind führend, wenn es um Visualisierung geht.</p>') !!}        
      </div>
    </div>
  </article>
</section>
@endsection