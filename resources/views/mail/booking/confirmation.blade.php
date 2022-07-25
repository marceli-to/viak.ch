@component('mail::message')
<h1>{{ __('Buchungsbestätigung') . ' – ' . $data->course->title }}</h1>
<p>{{ __('Guten Tag') }} Marcel Stadelmann</p>
<p>{{ __('Vielen Dank für deine Anmeldung für den Kurs') }} «{{ $data->course->title }}». {{ __('Dieser findet wie folgt statt:') }}</p>
<table class="content-table" cellpadding="0" cellspacing="0">
  <tr>
    <td width="140">{{ __('Kurs') }}</td>
    <td>{{ $data->course->title }}</td>
  </tr>
  <tr>
    <td>{{ __('Datum') }}</td>
    <td>{{ $data->date }}</td>
  </tr>
  <tr>
    <td>{{ __('Kosten') }}</td>
    <td>CHF {{ $data->fee ? $data->fee : $data->course->fee }}</td>
  </tr>
</table>
<p>{{ __('Die Rechnung sowie die definitive Einladung für den Kurs erhälst du in den nächsten Tagen.') }}</p>
<p>{{ __('Um diese Buchung zu annulieren, klicke bitte') }} <a href="" style="color: #000000; text-decoration: none;">{{ __('hier') }}</a>.</p>
<p>{{ __('Möchtest du weitere Kurse besuchen? Verwalte deine Kurse und deine persönlichen Daten bequem und einfach unter:') }} <a href="{{ route('page.student.profile') }}" target="_blank">viak.ch/profil</a></p>
@include('mail.partials.signature')
@endcomponent