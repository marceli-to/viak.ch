@component('mail::message')
<h1>{{ __('Annullationsbestätigung') . ' – ' . $data->event->course->title }}</h1>
<p>{{ __('Guten Tag') }} {{ $data->user->fullname }}</p>
<p>{{ __('Wir haben Deine Annullation für den Kurs «:attribute» erhalten.', ['attribute' => $data->event->course->title]) }}</p>
<p>{{ __('Die kurzfristige Annullation hat gemäss unseren AGB Kosten zur Folge. Diese belaufen sich auf CHF :amount.– (:penalty% der Kurskosten).', ['amount' => $cancellation['amount'], 'penalty' => $cancellation['penalty']]) }}</p>
@if ($invoice->isPaid() && $discount)
<p>{!! __('Da die gesamte Rechnung bereits bezahlt ist, haben wir Dir einen Rabatt-Code für den zuviel bezahlten Betrag ausgestellt. Dieser kann bei der nächsten Buchung angewendet werden und lautet: <nobr><strong>:code</strong></nobr>. Falls du lieber eine Rückerstattung des zuviel bezahlten Betrages möchtest, dann nimm bitte mit uns Kontakt auf.', ['code' => $discount->code]) !!}</p>
@elseif ($invoice->isPaid())
<p>{{ __('Da die Rechnung bereits bezahlt ist, musst Du nichts weiter unternehmen.') }}</p>
@else
<p>{{ __('Die entsprechende Rechnung liegt diesem Mail bei.') }}</p>
@endif
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
<p>{{ __('Möchtest Du eine andere Schulung besuchen? Unser Schulungsangebot findest Du unter:') }} <a href="{{ localized_route('page.courses') }}" target="_blank" style="color: #000000; text-decoration: none;"><strong>visualisierungs-akademie.ch/kurse</strong></a></p>
<p>{{ __('Bei Fragen stehen wir Dir gerne zur Verfügung.') }}</p>
@include('mail.partials.signature')
@endcomponent