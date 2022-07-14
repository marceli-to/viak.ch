@extends('layouts.auth')
@section('content')
<section class="auth">
  <h1>{{ __('Confirm Password') }}</h1>
  <div class="mb-6x">
    {{ __('Please confirm your password before continuing.') }}
  </div>
  @if ($errors->any())
    <x-alert type="danger" message="{{__('messages.general_error')}}" />
  @endif
  <form method="POST" action="{{ route('password.confirm') }}">
    @csrf
    <x-form-text-field type="password" name="password" placeholder="passwort" required />
    <div class="form-buttons">
      <x-form-button label="{{ __('Confirm Password') }}" name="register" btnClass="btn-primary" type="submit" />
      @if (Route::has('password.request'))
        <a class="form-helper" href="{{ route('password.request') }}">
          {{ __('Forgot Your Password?') }}
        </a>
      @endif
    </div>
  </form>
</section>
@endsection
