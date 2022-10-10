@component('mail::message')
<h1>{{ __('Annullationsbestätigung') . ' – ' . $data->event->course->title }}</h1>
<p>{{ __('Hallo') }} {{ $data->user->fullname }}</p>
<p>{{ __('Wir haben deine Annullation für den Kurs «:attribute» erhalten.', ['attribute' => $data->event->course->title]) }}</p>
<p>{{ __('Die kurzfristige Annullation hat gemäss unseren AGB kosten zur Folge. Diese belaufen sich auf CHF :amount.– (:penalty% der Kurskosten)', ['amount' => $cancellation['amount'], 'penalty' => $cancellation['penalty']]) }}</p>
<p>{{ __('Die entsprechende Rechnung liegt diesem Mail bei.') }}</p>
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
<p>{{ __('Möchtest einen anderen Kurs besuchen? Unser Kursangebot findest du unter:') }} 
  <a href="{{ route('page.courses') }}" target="_blank" style="color: #000000; text-decoration: none;">viak.ch/kurse</a>
</p>
@include('mail.partials.signature')
@endcomponent