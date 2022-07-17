@extends('web.layout.frontend')
@section('html_class', 'is-auth')
@section('seo_title', __('Benutzerrolle wählen'))
@section('content')
<section class="content">
  <x-article-text>
    <x-slot name="aside">
      <h1 class="xs:hide">{{ __('Benutzerrolle wählen') }}</h1>
      <div class="sm:mt-10x md:mt-20x">
        <a href="{{ route('logout') }}" class="!block icon-arrow-right" title="{{ __('Logout') }}">
          <span>{{ __('Logout') }}</span>
          @include('web.partials.icons.arrow-right')
        </a>
      </div>
    </x-slot>
    <x-slot name="content">
      <p>{!! __('Ihrem Profil sind mehrere Rollen zugewiesen:') !!}
      @if ($roles)
        <div class="mt-8x">
          @foreach($roles as $role)
            <div class="mb-4x">
              <a href="{{ route('page.role.set', ['role' => $role->uuid]) }}" class="btn-primary btn-half-w">{{ $role->name }}</a>
            </div>
          @endforeach
        </div>
      @endif
    </x-slot>
  </x-article-text>
</section>
@endsection