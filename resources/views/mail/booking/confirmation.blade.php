@component('mail::message')
<h1>{{ __('Buchungsbestätigung') . ' – ' . $data->event->course->title }}</h1>
<p>{{ __('Hallo') }} {{ $data->user->fullname }}</p>
<p>{{ __('Vielen Dank für deine Anmeldung für den Kurs') }} «{{ $data->event->course->title }}». {{ __('Dieser findet wie folgt statt:') }}</p>
<table class="content-table" cellpadding="0" cellspacing="0">
  <tr>
    <td width="140">{{ __('Kurs') }}</td>
    <td>{{ $data->event->course->title }}</td>
  </tr>
  <tr>
    <td>{{ __('Buchungs-Nr.') }}</td>
    <td>{{ $data->number }}</td>
  </tr>
  <tr>
    <td>{{ __('Datum') }}</td>
    <td>{{ collect($data->event->dates->pluck('date_short')->all())->implode(', ') }}</td>
  </tr>
  <tr>
    <td>{{ __('Kosten') }}</td>
    <td>CHF {{ $data->event->courseFee }}</td>
  </tr>
</table>
<p>{{ __('Die Rechnung sowie die definitive Einladung für den Kurs erhältst du in den nächsten Tagen.') }}</p>
<p>{{ __('Um diese Buchung zu annullieren, klicke bitte') }} <a href="{{ route('page.student.profile') }}" target="_blank" style="color: #000000; text-decoration: none;">{{ __('hier') }}</a>.</p>
<p>{{ __('Möchtest du weitere Kurse besuchen? Verwalte deine Kurse und deine persönlichen Daten bequem und einfach unter:') }} <a href="{{ route('page.student.profile') }}" target="_blank" style="color: #000000; text-decoration: none;">viak.ch/profil</a></p>
@include('mail.partials.signature')
@endcomponent