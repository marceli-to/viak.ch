@extends('web.layout.frontend')
@section('seo_title', __('Password bestätigen'))
@section('content')
<section class="content">
  @if ($errors->any())
    <x-alert type="danger" message="{{ __('Bitte überprüfen Sie Ihre Eingabe!') }}" />
  @endif
  <x-article-text>
    <x-slot name="aside">
      <h1>{{ __('Password bestätigen') }}</h1>
      @if (Route::has('password.request'))
        <a class="form-helper icon-arrow-right" href="{{ route('password.request') }}" title="{{ __('Passwort vergessen?') }}">
          <span>{{ __('Passwort vergessen?') }}</span>
          @include('web.partials.icons.arrow-right')
        </a>
      @endif
    </x-slot>
    <x-slot name="content">
      <p>{{ __('Bitte bestätigen Sie Ihr Passwort, bevor Sie fortfahren.') }}</p>
      <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <x-form-text-field type="password" label="{{ __('Passwort') }}" name="password" placeholder="passwort" required />
        <x-form-button label="{{ __('Passwort bestätigen') }}" name="submit" btnClass="btn-primary" type="submit" />
      </form>  
    </x-slot>
  </x-article-text>
</section>
@endsection