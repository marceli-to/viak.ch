@component('mail::message')
<h1>{{ __('Annullationsbestätigung') . ' – ' . $data->event->course->title }}</h1>
<p>{{ __('Guten Tag') }} {{ $data->user->fullname }}</p>
<p>{{ __('Wir haben Deine Annullation für den Kurs «:attribute» erhalten.', ['attribute' => $data->event->course->title]) }}</p>
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
</table>
<p>{{ __('Möchtest Du stattdessen einen anderen Kurs besuchen? Unser Schulungsangebot findest Du unter:') }} <a href="{{ localized_route('page.courses') }}" target="_blank" style="color: #000000; text-decoration: none;"><strong>viak.ch/kurse</strong></a></p>
@include('mail.partials.signature')
@endcomponent