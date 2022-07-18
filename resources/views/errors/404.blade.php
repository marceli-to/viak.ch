@extends('web.layout.frontend')
@section('mobile_page_title', __('Fehler') . ' 404')
@section('content')
<x-error>
  <h1>{{ __('Fehler') }} 404</h1>
  <p>{{ __('Die gewünschte Seite konnte leider nicht gefunden werden.') }}</p>
  @include('errors.partials.footer')
</x-error>
@endsection