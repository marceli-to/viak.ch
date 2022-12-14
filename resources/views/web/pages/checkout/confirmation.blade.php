@extends('web.layout.frontend')
@section('html_class', 'is-auth')
@section('page_title', __('Buchung abgeschlossen'))
@section('content')
<section class="container">
  <x-article-text>
    <x-slot name="aside">
      <h1 class="xs:hide">{{ __('Buchung abgeschlossen') }}</h1>
      <div class="sm:mt-5x md:mt-10x">
        <a href="{{ route('page.student.profile') }}" class="icon-arrow-right:below" title="{{ __('Zum Profil') }}">
          <span>{{ __('Zum Profil') }}</span>
          @include('web.partials.icons.arrow-right')
        </a>
      </div>
    </x-slot>
    <x-slot name="content">
      <p>{{ __('Vielen Dank für Deine Buchung. Du erhältst in den nächsten Minuten eine Bestätigung per E-Mail.') }}</p>
      <p>
        <a href="{{ localized_route('page.courses') }}" title="{{ __('Zum Kursangebot') }}" class="link-underline">
          {{ __('Zum Kursangebot') }}
        </a>
      </p>
    </x-slot>
  </x-article-text>
</section>
@endsection
