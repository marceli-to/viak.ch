@extends('web.layout.frontend')
@section('page_title', __('Buchung abgeschlossen'))
@section('content')
<section class="container">
  <x-article-text>
    <x-slot name="aside">
      <h1 class="xs:hide">{{ __('Buchung abgeschlossen') }}</h1>
    </x-slot>
    <x-slot name="content">
      <p>{{ __('Vielen Dank für Deine Buchung. Du erhältst in den nächsten Minuten eine Bestätigung per E-Mail.') }}</p>
    </x-slot>
  </x-article-text>
</section>
@endsection
