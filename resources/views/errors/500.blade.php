@extends('web.layout.frontend')
@section('mobile_page_title', __('Fehler') . ' 500')
@section('content')
<x-error>
  <h1>{{ __('Fehler') }} 500</h1>
  <p>Server error.</p>
  @include('errors.partials.footer')
</x-error>
@endsection
