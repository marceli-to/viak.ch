@extends('web.layout.frontend')
@section('html_class', 'is-auth')
@section('seo_title', __('Konto abschliessen'))
@section('page_title', __('Konto abschliessen'))
@section('content')

@if (isset($isConfirmed) && $isConfirmed)
  <section class="container">
    <x-article-text>
      <x-slot name="aside">
        <h1 class="xs:hide">{{ __('Konto eingerichtet') }}</h1>
      </x-slot>
      <x-slot name="content">
        <p>{{ __('Vielen Danke, dein Konto ist damit eingerichtet.') }}</p>
      </x-slot>
    </x-article-text>
  </section>
@else
  <section class="container">
    @if ($errors->any())
      <x-alert type="danger" message="{{ __('Hoppla, da ist etwas schiefgelaufen. Bitte überprüf deine Eingaben.') }}" />
    @endif
    <x-article-text>
      <x-slot name="aside">
        <h1 class="xs:hide">{{ __('Konto abschliessen') }}</h1>
      </x-slot>
      <x-slot name="content">
        <p>{{ __('Um die Erstellung deines Kontos abzuschliessen, musst du ein Passwort einrichten:') }}</p>
        <form method="POST" action="{{ route('auth.expert.finish') }}">
          @csrf
          <input type="hidden" name="uuid" value="{{ $uuid }}" />
          <x-form-text-field type="password" label="{{ __('Passwort (min. 8 Zeichen)') }}" name="password" />
          <x-form-text-field type="password" label="{{ __('Passwort bestätigen') }}" name="password_confirmation" />
          <x-form-button label="{{ __('Speichern') }}" name="submit" btnClass="btn-primary" type="submit" />
        </form>
      </x-slot>
    </x-article-text>
  </section>
@endif
@endsection