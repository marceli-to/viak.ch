@extends('web.layout.frontend')
@section('html_class', 'is-auth')
@section('seo_title', __('Benutzerrolle wählen'))
@section('page_title', __('Benutzerrollen'))
@section('content')
<section class="container">
  <x-article-text>
    <x-slot name="aside">
      <h1 class="xs:hide">{{ __('Benutzerrolle wählen') }}</h1>
      <div class="sm:mt-5x md:mt-10x">
        <a href="{{ route('logout') }}" class="icon-arrow-right:below" title="{{ __('Logout') }}">
          <span>{{ __('Logout') }}</span>
          @include('web.partials.icons.arrow-right')
        </a>
      </div>
    </x-slot>
    <x-slot name="content">
      <p>{!! __('Ihrem Profil sind mehrere Rollen zugewiesen:') !!}</p>
      @if ($roles)
        <div class="mt-8x">
          @foreach($roles as $role)
            <div class="mb-4x">
              <a href="{{ localized_route('page.role.set', ['role' => $role->uuid]) }}" class="btn-primary btn-half-w">{{ $role->name }}</a>
            </div>
          @endforeach
        </div>
      @endif
    </x-slot>
  </x-article-text>
</section>
@endsection