@extends('web.layout.frontend')
@section('page_title', __('Kontakt'))
@section('content')
<section class="container-contact">
  <x-article-text>
    <x-slot name="aside">
      <h1 class="xs:hide">{{ __('Get in touch') }}</h1>
    </x-slot>
    <x-slot name="content">
      <p>Visualisierungs-Akademie Schweiz GmbH<br>Limmatstrasse 291<br>CH-8005 Zürich<br>Schweiz</p><p><a href='tel:+41435014040' title='{{ __('per Telefon') }}'>+41 43 501 40 40</a><br><a href='mailto:mail@visualisierungs-akademie.ch' title='{{ __('per E-Mail') }}'>mail@visualisierungs-akademie.ch</a></p>
      <figure class="mt-4x sm:mt-6x md:mt-8x">
        <picture>
          <source media="(min-width: 700px)" data-srcset="/media/viak-keyvisual-map-preview.png">
          <img 
            data-src="/media/viak-keyvisual-map-preview.png" 
            src="/media/viak-placeholder-visual.png"
            width="1600" 
            height="900"
            title="{{ __('Google Maps') }}"
            class="is-responsive lazy"
            alt="{{ __('Google Maps') }}">
        </picture>
      </figure>
    </x-slot>
  </x-article-text>
</section>

<section class="container-about">
  <x-collapsible title="{{ __('Anreise') }}" :expanded="true">
    @include('web.pages.contact.partials.directions')
  </x-collapsible>
</section>

<section class="container-about">
  <x-collapsible title="{{ __('Über uns') }}">
    @include('web.pages.contact.partials.about')
  </x-collapsible>
</section>

<section class="container-team">
  <x-collapsible title="{{ __('Team') }}">
    @include('web.pages.contact.partials.team')
  </x-collapsible>
</section>

<section class="container-about">
  <x-collapsible title="{{ __('Impressum') }}">
    @include('web.pages.contact.partials.imprint')
  </x-collapsible>
</section>
@endsection


