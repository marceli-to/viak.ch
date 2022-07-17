@extends('web.layout.frontend')
@section('seo_title', __('Benutzerrolle wählen'))
@section('content')
<section class="content">
  <x-article-text>
    <x-slot name="aside">
      <h1>{{ __('Benutzerrolle wählen') }}</h1>
      @if (Route::has('password.request'))
        <p>
          <a href="{{ route('logout') }}" class="form-helper icon-arrow-right" title="{{ __('Logout') }}">
            <span>{{ __('Logout') }}</span>
            @include('web.partials.icons.arrow-right')
          </a>
        </p>
      @endif
    </x-slot>
    <x-slot name="content">
      <p>{{ __('Ihrem Profil sind mehrere Rollen zugewiesen. Bitte Rolle auswählen:') }}
      @if ($roles)
        @foreach($roles as $role)
          <div class="form-group">
            <a href="{{ route('page.role.set', ['role' => $role->uuid]) }}" class="btn-primary btn-half-w">{{ $role->name }}</a>
          </div>
        @endforeach
      @endif
    </x-slot>
  </x-article-text>
</section>
@endsection