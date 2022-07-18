@extends('web.layout.frontend')
@section('html_class', 'is-auth')
@section('seo_title', __('Login'))
@section('content')
<section class="content">
  @if ($errors->any())
    <x-alert type="danger" message="{{ __('Hoppla, da ist etwas schiefgelaufen. Bitte überprüf deine Eingaben.') }}" />
  @endif
  <x-article-text>
    <x-slot name="aside">
      <h1 class="xs:hide">{{ __('Login') }}</h1>
      <div class="sm:mt-10x md:mt-20x">
        <a href="{{ route('register') }}" class="!block icon-arrow-right" title="{{ __('Registrieren') }}">
          <span>{{ __('Nicht registriert?') }}</span>
          @include('web.partials.icons.arrow-right')
        </a>
      </div>
    </x-slot>
    <x-slot name="content">
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <x-form-text-field type="email" label="{{ __('E-Mail') }}" name="email" required autocomplete="false" aria-autocomplete="false" />
        <x-form-text-field type="password" label="{{ __('Passwort') }}" name="password" required autocomplete="false" />
        <x-form-button label="{{ __('Anmelden') }}" name="submit" btnClass="btn-primary" type="submit" />
      </form>
      @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}" class="form-helper" title="{{ __('Passwort vergessen?') }}">
          {{ __('Passwort vergessen?') }}
        </a>
      @endif
    </x-slot>
  </x-article-text>
</section>
@endsection