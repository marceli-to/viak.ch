@extends('web.layout.frontend')
@section('html_class', 'is-auth')
@section('seo_title', __('Login'))
@section('page_title', __('Login'))
@section('content')
<section class="container">
  @if ($errors->any())
    <x-notification style="error" message="{{ __('Es ist ein Fehler aufgetreten.') }}" />
  @endif
  <x-article-text>
    <x-slot name="aside">
      <h1 class="xs:hide">{{ __('Login') }}</h1>
      <div class="sm:mt-5x md:mt-10x">
        <a href="{{ localized_route('page.register.form') }}" class="icon-arrow-right:below" title="{{ __('Registrieren') }}">
          <span>{{ __('Nicht registriert?') }}</span>
          @include('web.partials.icons.arrow-right')
        </a>
      </div>
    </x-slot>
    <x-slot name="content">
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <x-form-text-field type="email" label="{{ __('E-Mail') }}" name="email" required autocomplete="off" aria-autocomplete="off" />
        <x-form-text-field type="password" label="{{ __('Passwort') }}" name="password" required autocomplete="off" />
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