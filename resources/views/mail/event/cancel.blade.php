@component('mail::message')
@if ($recipient == 'student')
<h1>{{ __('Kursabsage') . ' – ' . $event->course->title }}</h1>
<p>{{ __('Hallo') }} {{ $user->fullname }}</p>
<p>{{ __('Leider muss der folgende Kurs abgesagt werden:') }}</p>
<table class="content-table" cellpadding="0" cellspacing="0">
  <tr>
    <td width="120">{{ __('Buchung') }}</td>
    <td>{{ $booking->number }}</td>
  </tr>
  <tr>
    <td>{{ __('Kurs') }}</td>
    <td>{{ $event->course->title }}</td>
  </tr>
  <tr>
    <td>{{ __('Datum') }}</td>
    <td>{{ collect($event->dates->pluck('date_short')->all())->implode(', ') }}</td>
  </tr>
  <tr>
    <td>{{ __('Experten') }}</td>
    <td>{{ collect($event->experts->pluck('fullname')->all())->implode(', ') }}
  </tr>
</table>
<p>{{ __('Deine Buchung für diesen Kurs wurde automatisch annulliert.') }} {{ __('Möchtest du einen anderen Kurse besuchen? Unsere Kurse und Angebote findest du ') }} <a href="{{ route('page.courses') }}" target="_blank" style="color: #000000; text-decoration: none; font-weight:bold"><strong>hier</strong></a>.</p>
@endif

@if ($recipient == 'expert')
<h1>{{ __('Kursabsage') . ' – ' . $event->course->title }}</h1>
<p>{{ __('Leider muss der folgende Kurs abgesagt werden:') }}</p>
<table class="content-table" cellpadding="0" cellspacing="0">
  <tr>
    <td width="120">{{ __('Kurs') }}</td>
    <td>{{ $event->course->title }}</td>
  </tr>
  <tr>
    <td>{{ __('Datum') }}</td>
    <td>{{ collect($event->dates->pluck('date_short')->all())->implode(', ') }}</td>
  </tr>
  <tr>
    <td>{{ __('Experten') }}</td>
    <td>{{ collect($event->experts->pluck('fullname')->all())->implode(', ') }}
  </tr>
</table>
@endif
@include('mail.partials.signature')
@endcomponent