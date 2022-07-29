@extends('web.layout.frontend')
@section('seo_title', __('Home'))
@section('content')
<section class="container">
  <article class="content-text-media is-reverse">
    <figure class="text-media__visual">
      <img src="/media/viak-keyvisual-home.jpg" width="1600" height="900" alt="Ihre Zukunft ist visuell">
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