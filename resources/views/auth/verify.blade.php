@extends('web.layout.frontend')
@section('html_class', 'is-auth')
@section('seo_title', __('E-Mail verifizieren'))
@section('content')
<section class="content">
  @if (session('resent'))
    <x-alert type="success" message="{{ __('Neuer Bestätigungslink gesendet. Bitte Posteingang prüfen.') }}" />
  @endif
  <x-article-text>
    <x-slot name="aside">
      <h1 class="xs:hide">{{ __('E-Mail verifizieren') }}</h1>
    </x-slot>
    <x-slot name="content">
      <p>{{__('Bevor Du weiterfahren kannst, musst Du deine E-Mail-Adresse bestätigen. Wir haben Dir dazu eine E-Mail mit einem Bestätigungs-Link geschickt.') }}</p>
      <p>{{__('Falls Du keine E-Mail erhalten hast, kannst Du einen neuen Link anfordern:') }}</p>
      <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <x-form-button label="{{ __('Anfordern') }}" name="request-link" btnClass="btn-primary" type="submit" />
      </form>
    </x-slot>
  </x-article-text>
</section>
@endsection
