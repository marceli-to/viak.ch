@component('mail::message')
<h1>{{ __('Kursbestätigung') . ' – ' . $event->course->title }}</h1>
@if ($recipient == 'student')
<p>{{ __('Hallo') }} {{ $user->fullname }}</p>
<p>{{ __('Hiermit bestätigen wir die Durchführung des oben erwähnten Kurses:') }}</p>
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
  @if ($event->online)
    <tr>
      <td>{{ __('Ort') }}</td>
      <td>{{ __('online') }}</td>
    </tr>
  @else
    <tr>
      <td>{{ __('Ort') }}</td>
      <td>{{ $event->location ? $event->location->description : '' }}</td>
    </tr>
  @endif
  <tr>
    <td>{{ __('Kosten') }}</td>
    <td>CHF {{ $event->courseFee }}</td>
  </tr>
</table>
<p>{{ __('Die Rechnung für die Kurskosten findest Du in der Beilage. Falls Du die Rechnung wie Kreditkarte bezahlen möchtest, klick bitte auf den nachfolgenden Link.') }}</p>
<p class="py-2x"><a href="{{ route('page.payment.overview', ['invoice' => $invoice->uuid]) }}" target="_blank" class="button button-primary" style="text-decoration: none;"><strong>{{ __('Zahlung per Kreditkarte') }}</strong></a></p>
<p>{{ __('Möchtest Du weitere Kurse besuchen? Verwalte Deine Kurse und Deine persönlichen Daten bequem und einfach unter:') }} <a href="{{ route('page.student.profile') }}" target="_blank" style="color: #000000; text-decoration: none; font-weight:bold"><strong>viak.ch/profil</strong></a></p>
@endif

@if ($recipient == 'expert')
<p>{{ __('Hiermit bestätigen wir die Durchführung des oben erwähnten Kurses:') }}</p>
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
<p>{{ __('Weitere Informationen zu diesem Kurs findest Du ') }} <a href="{{ route('page.expert.profile.course.event', ['uuid' => $event->uuid]) }}" target="_blank" style="color: #000000; text-decoration: none;"><strong>{{ __('hier') }}</strong></a>.</p>
@endif

@include('mail.partials.signature')
@endcomponent