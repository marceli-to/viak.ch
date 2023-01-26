@component('mail::message')
@if ($recipient == 'student')
<h1>{{ __('Kursabsage') . ' – ' . $event->course->title }}</h1>
<p>{{ __('Guten Tag') }} {{ $user->fullname }}</p>
<p>{{ __('Leider müssen wir den folgenden Kurs absagen:') }}</p>
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
    <td>{{ $event->experts_fullname_string }}
  </tr>
</table>
<p>{{ __('Deine Buchung für diesen Kurs wurde automatisch annulliert.') }}</p>
<p>{{ __('Falls der Kurs an einem neuen Datum stattfinden wird, so findest Du dieses in Kürze auf unserer Website.') }}</p>
<p>{{ __('Bei Fragen stehen wir Dir natürlich gerne zur Verfügung.') }}</p>
<p>{{ __('Möchtest Du eine andere Schulung besuchen? Unsere Kurse und Angebote findest Du ') }} <a href="{{ localized_route('page.courses') }}" target="_blank" style="color: #000000; text-decoration: none; font-weight:bold"><strong>hier</strong></a>.</p>
@endif

@if ($recipient == 'expert')
<h1>{{ __('Kursabsage') . ' – ' . $event->course->title }}</h1>
<p>{{ __('Leider müssen wir den folgenden Kurs absagen:') }}</p>
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
    <td>{{ $event->experts_fullname_string }}
  </tr>
</table>
@endif
@include('mail.partials.signature')
@endcomponent