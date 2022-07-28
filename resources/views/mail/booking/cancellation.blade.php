@component('mail::message')
<h1>{{ __('Annullationsbestätigung') . ' – ' . $data->course->title }}</h1>
<p>{{ __('Guten Tag') }} Marcel Stadelmann</p>
<p>{{ __('Wir haben deine Annullation für den Kurs «:attribute» erhalten.', ['attribute' => $data->course->title]) }}</p>
<table class="content-table" cellpadding="0" cellspacing="0">
  <tr>
    <td width="140">{{ __('Kurs') }}</td>
    <td>{{ $data->course->title }}</td>
  </tr>
  <tr>
    <td>{{ __('Datum') }}</td>
    <td>{{ collect($data->dates->pluck('date_short')->all())->implode(', ') }}</td>
  </tr>
</table>
<p>{{ __('Möchtest einen anderen Kurs besuchen? Unser Kursangebot findest du unter:') }} 
  <a href="{{ route('page.courses') }}" target="_blank" style="color: #000000; text-decoration: none;">viak.ch/kurse</a>
</p>
@include('mail.partials.signature')
@endcomponent