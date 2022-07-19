@extends('web.layout.frontend')
@section('page_title', __('Fehler') . ' 503')
@section('content')
<x-error>
  <h1>{{ __('Fehler') }} 503</h1>
  <p>Server error.</p>
  @include('errors.partials.footer')
</x-error>
@endsection
