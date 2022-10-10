@component('mail::message')
<h1>{{ __('Bestätigung') . ' – ' . $data->course->title }}</h1>
<p>{{ __('Hallo') }}</p>
<p>{{ __('Hiermit bestätigen wir die Durchführung des oben erwähnten Kurses:') }}</p>
<table class="content-table" cellpadding="0" cellspacing="0">
  <tr>
    <td width="120">{{ __('Kurs') }}</td>
    <td>{{ $data->course->title }}</td>
  </tr>
  <tr>
    <td>{{ __('Datum') }}</td>
    <td>{{ collect($data->dates->pluck('date_short')->all())->implode(', ') }}</td>
  </tr>
  <tr>
    <td>{{ __('Experten') }}</td>
    <td>{{ collect($data->experts->pluck('fullname')->all())->implode(', ') }}
  </tr>
  <tr>
    <td>{{ __('Kosten') }}</td>
    <td>CHF {{ $data->courseFee }}</td>
  </tr>
</table>
<p>{{ __('Die Rechnung für die Kurskosten findest du in der Beilage. Falls du die Rechnung wie Kreditkarte bezahlen möchtest, klick bitte auf den nachfolgenden Link.') }}</p>
<p><a href="{{ route('page.student.profile') }}" target="_blank" class="button-primary" style="text-decoration: none;"><strong>{{ __('Mit Kreditkarte bezahlen') }}</strong></a></p>
<p>{{ __('Möchtest du weitere Kurse besuchen? Verwalte deine Kurse und deine persönlichen Daten bequem und einfach unter:') }} <a href="{{ route('page.student.profile') }}" target="_blank" style="color: #000000; text-decoration: none; font-weight:bold"><strong>viak.ch/profil</strong></a></p>
@include('mail.partials.signature')
@endcomponent