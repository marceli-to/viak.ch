@extends('web.layout.frontend')
@section('seo_title', 'Login')
@section('content')
@if ($errors->any())
  <x-alert type="danger" message="{{__('messages.general_error')}}" />
@endif
<form method="POST" action="{{ route('login') }}" class="auth">
  @csrf
  <x-form-text-field type="email" name="email" required autocomplete="false" aria-autocomplete="false" placeholder="mail@beispiel.ch" />
  <x-form-text-field type="password" name="password" required autocomplete="false" placeholder="passwort" />
  <div class="form-buttons">
    <x-form-button label="Anmelden" name="register" btnClass="btn-primary" type="submit" />
    @if (Route::has('password.request'))
      <a href="{{ route('password.request') }}" class="form-helper">Passwort vergessen?</a>
    @endif
  </div>
</form>
@endsection