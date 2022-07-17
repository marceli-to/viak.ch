@extends('web.layout.frontend')
@section('html_class', 'is-auth')
@section('seo_title', __('Registrieren'))
@section('content')
<section class="content" id="app-register">
  <register-form />
  {{-- @if ($errors->any())
    <x-alert type="danger" message="{{ __('Hoppla, da ist etwas schiefgelaufen. Bitte überprüf deine Eingaben.') }}" />
  @endif --}}
  <x-article-text>
    <x-slot name="aside">
      <h1 class="xs:hide">{{ __('Registrieren') }}</h1>
      <div class="sm:mt-10x md:mt-20x">
        <a href="{{ route('login') }}" class="!block icon-arrow-right" title="{{ __('Login') }}">
          <span>{{ __('Bereits registriert?') }}</span>
          @include('web.partials.icons.arrow-right')
        </a>
      </div>
    </x-slot>
    <x-slot name="content">
      <form method="POST" action="{{ route('register') }}" class="auth">
        @csrf
        <x-form-text-field type="text" label="{{ __('Vorname') }}" name="firstname" required />
        <x-form-text-field type="text" label="{{ __('Name') }}" name="lastname" required />
        <x-form-text-field type="text" label="{{ __('Telefon') }}" name="phone" required />
        <div class="sm:grid-cols-12">
          <div class="span-6">
            <x-form-text-field type="text" label="{{ __('Strasse') }}" name="street" required />
          </div>
          <div class="span-6">
            <x-form-text-field type="text" label="{{ __('Nr.') }}" name="street_no" required />
          </div>
        </div>
        <div class="sm:grid-cols-12">
          <div class="span-6">
            <x-form-text-field type="text" label="{{ __('PLZ') }}" name="zip" required />
          </div>
          <div class="span-6">
            <x-form-text-field type="text" label="{{ __('Ort') }}" name="city" required />
          </div>
        </div>
        <x-form-text-field type="email" label="{{ __('E-Mail') }}" name="email" required autocomplete="false" aria-autocomplete="false" />
        <x-form-text-field type="password" label="{{ __('Passwort') }}" name="password" required autocomplete="false" />
        <x-form-button label="{{ __('Anmelden') }}" name="submit" btnClass="btn-primary" type="submit" />
      </form>
    </x-slot>
  </x-article-text>
</section>
<script src="{{ mix('assets/js/register.js') }}" type="text/javascript"></script>
@endsection
