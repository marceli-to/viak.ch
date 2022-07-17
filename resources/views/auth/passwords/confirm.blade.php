@extends('web.layout.frontend')
@section('html_class', 'is-auth')
@section('seo_title', __('Password bestätigen'))
@section('content')
<section class="content">
  @if ($errors->any())
    <x-alert type="danger" message="{{ __('Hoppla, da ist etwas schiefgelaufen. Bitte überprüf deine Eingaben.') }}" />
  @endif
  <x-article-text>
    <x-slot name="aside">
      <h1 class="xs:hide">{{ __('Password bestätigen') }}</h1>
    </x-slot>
    <x-slot name="content">
      <p>{{ __('Bitte bestätigen Sie Ihr Passwort, bevor Sie fortfahren.') }}</p>
      <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <x-form-text-field type="password" label="{{ __('Passwort') }}" name="password" placeholder="passwort" required />
        <x-form-button label="{{ __('Passwort bestätigen') }}" name="submit" btnClass="btn-primary" type="submit" />
      </form>
      @if (Route::has('password.request'))
        <a class="form-helper" href="{{ route('password.request') }}" title="{{ __('Passwort vergessen?') }}">
          {{ __('Passwort vergessen?') }}
        </a>
      @endif
    </x-slot>
  </x-article-text>
</section>
@endsection