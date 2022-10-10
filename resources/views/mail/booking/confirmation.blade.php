@component('mail::message')
<h1>{{ __('Buchungsbestätigung') . ' – ' . $data->event->course->title }}</h1>
<p>{{ __('Hallo') }} {{ $data->user->fullname }}</p>
<p>{{ __('Vielen Dank für deine Anmeldung für den Kurs') }} «{{ $data->event->course->title }}». {{ __('Gerne bestätigen wir deine Anmeldung wie folgt:') }}</p>
<table class="content-table" cellpadding="0" cellspacing="0">
  <tr>
    <td width="120">{{ __('Buchung') }}</td>
    <td>{{ $data->number }}</td>
  </tr>
  <tr>
    <td>{{ __('Kurs') }}</td>
    <td>{{ $data->event->course->title }}</td>
  </tr>
  <tr>
    <td>{{ __('Datum') }}</td>
    <td>{{ collect($data->event->dates->pluck('date_short')->all())->implode(', ') }}</td>
  </tr>
  @if ($data->event->online)
    <tr>
      <td>{{ __('Ort') }}</td>
      <td>{{ __('online') }}</td>
    </tr>
  @else
    <tr>
      <td>{{ __('Ort') }}</td>
      <td>{{ $data->event->location ? $data->event->location->description : '' }}</td>
    </tr>
  @endif
  <tr>
    <td>{{ __('Kosten') }}</td>
    <td>CHF {{ $data->event->courseFee }}</td>
  </tr>
</table>
<p>{{ __('Die Rechnung sowie die definitive Einladung für den Kurs erhältst du in den nächsten Tagen.') }}</p>
<p>{{ __('Um diese Buchung zu annullieren, klicke bitte') }} <a href="{{ route('page.student.profile') }}" target="_blank" style="color: #000000; text-decoration: none;"><strong>{{ __('hier') }}</strong></a>.</p>
<p>{{ __('Möchtest du weitere Kurse besuchen? Verwalte deine Kurse und deine persönlichen Daten bequem und einfach unter:') }} <a href="{{ route('page.student.profile') }}" target="_blank" style="color: #000000; text-decoration: none; font-weight:bold"><strong>viak.ch/profil</strong></a></p>
@include('mail.partials.signature')
@endcomponent