@component('mail::message')
@if ($recipient == 'student')
<h1>{{ __('Zahlungsbestätigung Rechnung') . ' ' . $invoice->number }}</h1>
<p>{{ __('Hallo') }} {{ $invoice->user->fullname }}</p>
<p>{{ __('Wir haben deine Zahlung erhalten, welche wir gerne wie folgt bestätigen:') }}</p>
<table class="content-table" cellpadding="0" cellspacing="0">
  <tr>
    <td width="120">{{ __('Rechnung') }}</td>
    <td>{{ $invoice->number }}</td>
  </tr>
  <tr>
    <td>{{ __('Betrag') }}</td>
    <td>CHF {{ $invoice->grand_total }}</td>
  </tr>
  <tr>
    <td>{{ __('Datum') }}</td>
    <td>{{ $invoice->paid_at_str }}</td>
  </tr>
  <tr>
    <td>{{ __('Bezahlt per') }}</td>
    <td>{{ __('Kreditkarte') }}</td>
  </tr>
</table>
<p>{{ __('Möchtest Du weitere Kurse besuchen? Verwalte Deine Kurse und Deine persönlichen Daten bequem und einfach unter:') }} <a href="{{ route(locale() . '.page.student.profile') }}" target="_blank" style="color: #000000; text-decoration: none; font-weight:bold"><strong>viak.ch/profil</strong></a></p>
@endif

@if ($recipient == 'admin')
<h1>{{ __('Zahlungseingang') }}</h1>
<p>{{ __('Folgende Rechnung wurde per Kreditkarte bezahlt:') }}</p>
<table class="content-table" cellpadding="0" cellspacing="0">
  <tr>
    <td width="120">{{ __('Rechnung') }}</td>
    <td>{{ $invoice->number }}</td>
  </tr>
  <tr>
    <td>{{ __('Betrag') }}</td>
    <td>CHF {{ $invoice->grand_total }}</td>
  </tr>
  <tr>
    <td>{{ __('Datum') }}</td>
    <td>{{ $invoice->paid_at_str }}</td>
  </tr>
  <tr>
    <td>{{ __('Teilnehmer') }}</td>
    <td>{{ $invoice->user->fullname }}, {{$invoice->user->city }}</td>
  </tr>
</table>
@endif
@include('mail.partials.signature')
@endcomponent