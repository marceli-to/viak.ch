@extends('web.layout.frontend')
@section('content')
<section class="content content--contact">
  <x-article-text-media 
    image="viak-keyvisual-map-preview.png" 
    title="{{ __('Get in touch') }}" 
    text="<p>Visualisierungs-Akademie Schweiz GmbH<br>Limmatstrasse 291<br>CH-8005 Zürich<br>Schweiz</p><p><a href='tel:+41435014040' title='{{ __('per Telefon') }}'>+41 43 501 40 40</a><br><a href='mailto:mail@visualisierungs-akademie.ch' title='{{ __('per E-Mail') }}'>mail@visualisierungs-akademie.ch</a></p>"
    :reverse="true"
  />
</section>

<section class="content content--about">
  <x-collapsible title="{{ __('Anreise') }}" :expanded="true">
    @include('web.pages.contact.partials.directions')
  </x-collapsible>
</section>

<section class="content content--about">
  <x-collapsible title="{{ __('Über uns') }}">
    @include('web.pages.contact.partials.about')
  </x-collapsible>
</section>

<section class="content content--team">
  <x-collapsible title="{{ __('Team') }}">
    @include('web.pages.contact.partials.team')
  </x-collapsible>
</section>

<section class="content content--about">
  <x-collapsible title="{{ __('Impressum') }}">
    @include('web.pages.contact.partials.imprint')
  </x-collapsible>
</section>
@endsection


