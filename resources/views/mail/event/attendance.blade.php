@component('mail::message')
<h1>{{ __('Teilnahmebestätigung') . ' – ' . $event->course->title }}</h1>
<p>{{ __('Hallo') }} {{ $user->fullname }}</p>
<p>{{ __('Hiermit bestätigen wir Deine Teilnahme am folgenden Kurs:') }}</p>
<table class="content-table" cellpadding="0" cellspacing="0">
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
</table>
<p>{{ __('Möchtest Du weitere Kurse besuchen? Verwalte Deine Kurse und Deine persönlichen Daten bequem und einfach unter:') }} <a href="{{ route('page.student.profile') }}" target="_blank" style="color: #000000; text-decoration: none; font-weight:bold"><strong>viak.ch/profil</strong></a></p>
@include('mail.partials.signature')
@endcomponent