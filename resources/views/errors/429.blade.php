@extends('web.layout.frontend')
@section('page_title', __('Fehler') . ' 429')
@section('content')
<x-error>
  <h1>{{ __('Fehler') }} 429</h1>
  <p>{{ __('Der Zugriff auf diese Seite wurde verweigert.') }}</p>
  @include('errors.partials.footer')
</x-error>
@endsection
