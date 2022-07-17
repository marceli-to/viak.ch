@extends('web.layout.frontend')
@section('html_class', 'is-auth')
@section('seo_title', __('Login'))
@section('content')
<section class="content">
  @if ($errors->any())
    <x-alert type="danger" message="{{ __('Bitte überprüfen Sie Ihre Eingabe!') }}" />
  @endif
  <x-article-text>
    <x-slot name="aside">
      <h1>{{ __('Login') }}</h1>
      <p>
        <a href="{{ route('password.request') }}" class="form-helper icon-arrow-right">
          <span>{{ __('Nicht registriert?') }}</span>
          @include('web.partials.icons.arrow-right')
        </a>
      </p>

      @if (Route::has('password.request'))
        <p>
          <a href="{{ route('password.request') }}" class="form-helper icon-arrow-right">
            <span>{{ __('Passwort vergessen?') }}</span>
            @include('web.partials.icons.arrow-right')
          </a>
        </p>
      @endif
    </x-slot>
    <x-slot name="content">
      <form method="POST" action="{{ route('login') }}" class="auth">
        @csrf
        <x-form-text-field type="email" label="{{ __('E-Mail') }}" name="email" required autocomplete="false" aria-autocomplete="false" />
        <x-form-text-field type="password" label="{{ __('Passwort') }}" name="password" required autocomplete="false" />
        <x-form-button label="{{ __('Anmelden') }}" name="submit" btnClass="btn-primary" type="submit" />
      </form>  
    </x-slot>
  </x-article-text>
</section>
@endsection