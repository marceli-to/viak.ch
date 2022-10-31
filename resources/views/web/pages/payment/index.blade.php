@extends('web.layout.frontend')
@section('html_class', 'is-auth')
@section('seo_title', __('Kreditkartenzahlung'))
@section('page_title', __('Kreditkartenzahlung'))
@section('content')
<section class="container">
  <x-article-text>
    <x-slot name="aside">
      <h1 class="xs:hide">{{ __('Kreditkartenzahlung') }}</h1>
    </x-slot>
    <x-slot name="content">
      <p>Informationen bezüglich akzeptiere Kreditkarten, Weiterleitung auf Seite des Anbieters etc.</p>
    </x-slot>
  </x-article-text>
  <div class="stacked-list-container">
    <header class="stacked-list-header">
      <div class="sm:span-4">
        <strong>{{ __('Schritt') }} 1/1</strong>
      </div>
      <div class="sm:span-8">
      </div>
    </header>
    <article class="stacked-list-event">
      <div>
        <div class="stacked-list__col">
          <div>
            <h2>
              <a href="/{{ __('kurs') }}/{{ $booking->event->course->slug }}/{{ $booking->event->course->uuid }}" title="{{ $booking->event->course->title }}">
                {{ $booking->event->course->title }}
              </a>
            </h2>
            @if ($booking->event->dates)
              @if ($booking->event->dates->count() == 1)
                <strong>{{ $booking->event->dates[0]->date }}</strong><br>
                {{ $booking->event->dates[0]->time_start }} – {{ $booking->event->dates[0]->time_end }} {{ __('Uhr') }}
              @else
                @foreach($booking->event->dates as $date)
                  <strong>{{ $date->date }}</strong><br>
                  {{ $date->time_start }} – {{ $date->time_end }} {{ __('Uhr') }}<br>
                @endforeach
              @endif
            @endif
          </div>
        </div>
        <div class="stacked-list__col">
          @if ($booking->event->online)
            {{ __('Online') }}
          @elseif ($booking->event->location && $booking->event->location->description)
            {{ $booking->event->location->description }}
          @endif
          @if ($booking->event->experts)
            <div>{{ __('mit') }} {{ $booking->event->experts_fullname_string }}</div>
          @endif
        </div>
        <div class="justify-end stacked-list__col stacked-list__col--action">
          <div>
            <div>CHF {{ $booking->event->fee }}</div>
          </div>
        </div>
      </div>
    </article>
    <article data-touch="" class="stacked-list-item">
      <div>
        <div class="sm:span-4">
          <strong>{{ __('Total') }}</strong><br>{{ __('inkl. 0% Mehrwertsteuer') }}
        </div>
        <div class="sm:span-8 sm:align-right">
          <strong>CHF {{ $booking->event->fee }}</strong>
        </div>
      </div>
    </article>

    <footer class="stacked-list-footer">

      <form action="{{ route('page.payment.checkout.session') }}" method="POST" class="span-12">
        @csrf
        <input type="hidden" name="invoice" value="{{ $invoice->uuid }}" />
        <button type="submit" class="btn-next btn-next-wide">
          <span>{{ __('Weiter zur Zahlung') }}</span>
          <div>
            @include('web.partials.icons.arrow-right')
          </div>
        </button>
      </form>

    </footer>
  </div>
</section>
@endsection