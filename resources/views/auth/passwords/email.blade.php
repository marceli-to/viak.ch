@extends('web.layout.frontend')
@section('html_class', 'is-auth')
@section('seo_title', __('Passwort vergessen'))
@section('page_title', __('Passwort vergessen'))
@section('content')
<section class="container">
  @if ($errors->any())
    <x-notification style="error" message="{{ __('Es ist ein Fehler aufgetreten.') }}" />
  @endif
  @if (session('status'))
    <x-notification style="success" message="{{ session('status') }}" />
  @endif
  <x-article-text>
    <x-slot name="aside">
      <h1 class="xs:hide">{{ __('Passwort vergessen') }}</h1>
    </x-slot>
    <x-slot name="content">
      <p>{{__('Halb so wild - alles was wir brauchen ist Ihre E-Mail und Sie erhalten einen Link um das Passwort zurücksetzen zu können.')}}</p>
      <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <x-form-text-field type="email" label="{{ __('E-Mail') }}" name="email" required />
        <x-form-button label="{{ __('Link anfordern') }}" name="register" btnClass="btn-primary" type="submit" />
      </form>
      <a href="{{ route('login') }}" class="form-helper" title="{{ __('Zurück') }}">
        {{ __('Login') }}
      </a>
    </x-slot>
  </x-article-text>
</section>
@endsection