@extends('web.layout.frontend')
@section('page_title', __('Fehler') . ' 419')
@section('content')
<x-error>
  <h1>{{ __('Fehler') }} 419</h1>
  <p>{{ __('Der Zugriff auf diese Seite wurde verweigert.') }}</p>
  @include('errors.partials.footer')
  <p>
    <a href="{{ route('logout') }}" title="{{ __('Logout') }}" class="link-underline">
      {{ __('Logout') }}
    </a>
  </p>
</x-error>
@endsection
