@extends('web.layout.frontend')
@section('html_class', 'is-auth')
@section('seo_title', __('Passwort zurücksetzen'))
@section('page_title', __('Passwort zurücksetzen'))
@section('content')
<section class="content">
  @if ($errors->any())
    <x-alert type="danger" message="{{ __('Hoppla, da ist etwas schiefgelaufen. Bitte überprüf deine Eingaben.') }}" />
  @endif
  @if (session('status'))
    <x-alert type="success" message="{{ session('status') }}" />
  @endif
  <x-article-text>
    <x-slot name="aside">
      <h1 class="xs:hide">{{ __('Passwort zurücksetzen') }}</h1>
    </x-slot>
    <x-slot name="content">
      <p>{{__('Fast geschafft - wir brauchen die E-Mail sowie ein neues Passwort sowie eine Bestätigung des neuen Passworts.')}}</p>
      <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <x-form-text-field label="{{ __('E-Mail') }}" type="email" required name="email" />
        <x-form-text-field label="{{ __('Passwort') }}" type="password" required name="password" />
        <x-form-text-field label="{{ __('Passwort wiederholen') }}" type="password" name="password_confirmation" required autocomplete="new-password" />
        <x-form-button label="{{ __('Zurücksetzen') }}" name="reset_password" btnClass="btn-primary" type="submit" />
      </form>
    </x-slot>
  </x-article-text>
</section>
@endsection

