@component('mail::message')
<h1>{{ __('Bestätigung Kurs ') . $data->course->title }}</h1>
<p>Guten Tag Marcel Stadelmann</p>
<p>Vielen Dank für deine Anmeldung für den Kurs «{{ $data->course->title }}». Dieser findet wie folgt statt:</p>
<table class="content-table" cellpadding="0" cellspacing="0">
  <tr>
    <td width="140">Kurs</td>
    <td>{{ $data->course->title }}</td>
  </tr>
  <tr>
    <td>Datum</td>
    <td>{{ $data->date }}</td>
  </tr>
  <tr>
    <td>Kosten</td>
    <td>CHF {{ $data->course->fee }}</td>
  </tr>
</table>
<p>Die Rechnung sowie die definitive Einladung für den Kurs erhälst du in den nächsten Tagen.</p>
<p>Um diese Buchung zu annulieren, klicke bitte <a href="" style="color: #000000; text-decoration: none;">hier</a>.</p>
<p>Möchtest du weitere Kurse besuchen? Verwalte deine Kurse und deine persönlichen Daten bequem und einfach unter: <a href="{{ route('page.student.profile') }}" target="_blank">viak.ch/profil</a></p>
@include('mail.partials.signature')
@endcomponent