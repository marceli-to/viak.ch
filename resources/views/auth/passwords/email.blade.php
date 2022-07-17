@extends('web.layout.frontend')
@section('seo_title', __('Passwort vergessen'))
@section('content')
<section class="content">
  @if ($errors->any())
    <x-alert type="danger" message="{{ __('Bitte überprüfen Sie Ihre Eingabe!') }}" />
  @endif
  @if (session('status'))
    <x-alert type="success" message="{{ session('status') }}" />
  @endif
  <x-article-text>
    <x-slot name="aside">
      <h1>{{ __('Passwort vergessen') }}</h1>
      <p>
        <a href="{{ route('login') }}" class="form-helper icon-arrow-right" title="{{ __('Zurück') }}">
          <span>{{ __('Zurück') }}</span>
          @include('web.partials.icons.arrow-right')
      </a>
      </p>
    </x-slot>
    <x-slot name="content">
      <p>{{__('Halb so wild - alles was wir brauchen ist Ihre E-Mail und Sie erhalten einen Link um das Passwort zurücksetzen zu können.')}}</p>
      <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <x-form-text-field type="email" label="{{ __('E-Mail') }}" name="email" required />
        <x-form-button label="{{ __('Link anfordern') }}" name="register" btnClass="btn-primary" type="submit" />
      </form>
    </x-slot>
  </x-article-text>
</section>
@endsection