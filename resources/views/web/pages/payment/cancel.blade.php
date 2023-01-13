@extends('web.layout.frontend')
@section('html_class', 'is-auth')
@section('seo_title', __('Zahlungsvorgang abgebrochen'))
@section('page_title', __('Zahlungsvorgang abgebrochen'))
@section('content')
<section class="container-contact">
  <x-article-text>
    <x-slot name="aside">
      <h1 class="xs:hide">{{ __('Zahlungsvorgang abgebrochen') }}</h1>
    </x-slot>
    <x-slot name="content">
      <p>Du hast den Zahlungsvorgang abgebrochen. Brauchst Du Hilfe bei der Zahlung oder gibt es andere Gründe? Kontaktiere uns!</p>
      <p><a href='tel:+41435014040' title='{{ __('per Telefon') }}'>+41 43 501 40 40</a><br><a href='mailto:hallo@visualisierungs-akademie.ch' title='{{ __('per E-Mail') }}'>hallo@visualisierungs-akademie.ch</a></p>
    </x-slot>
  </x-article-text>
</section>
@endsection