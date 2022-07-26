@extends('web.layout.frontend')
@section('page_title', __('Fehler') . ' 401')
@section('content')
<section class="container-error">
  <h1>{{ __('Fehler') }} 401</h1>
  <p>{{ __('Der Zugriff auf diese Seite wurde verweigert.') }}</p>
  @include('errors.partials.footer')
</section>
@endsection
