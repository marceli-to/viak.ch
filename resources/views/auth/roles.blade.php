@extends('web.layout.frontend')
@section('html_class', 'is-auth')
@section('seo_title', __('Benutzerrolle wählen'))
@section('content')
<section class="content">
  <x-article-text>
    <x-slot name="aside">
      <h1 class="xs:hide">{{ __('Benutzerrolle wählen') }}</h1>
    </x-slot>
    <x-slot name="content">
      <p>{{ __('Ihrem Profil sind mehrere Rollen zugewiesen. Bitte Rolle auswählen:') }}
      @if ($roles)
        @foreach($roles as $role)
          <div class="form-group">
            <a href="{{ route('page.role.set', ['role' => $role->uuid]) }}" class="btn-primary btn-half-w !xs:btn-full-w">{{ $role->name }}</a>
          </div>
        @endforeach
      @endif
      <a href="{{ route('logout') }}" class="form-helper" title="{{ __('Logout') }}">
        {{ __('Logout') }}
      </a>
    </x-slot>
  </x-article-text>
</section>
@endsection