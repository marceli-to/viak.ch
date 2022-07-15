@extends('web.layout.frontend')
@section('content')
<section class="content content--home">
  <x-article-text-media 
    image="viak-keyvisual-home.jpg" 
    title="Ihre Zukunft ist visuell" 
    text="<p>Visualisieren ist die Schlüsselkompetenz der Zukunft. Wir machen Dich fit: zum Beispiel in unseren vielseitigen Kursen oder massgeschneiderten Individualschulungen.</p><p>Wir sind führend, wenn es um Visualisierung geht.</p>"
    :reverse="true"
  />
</section>
@endsection