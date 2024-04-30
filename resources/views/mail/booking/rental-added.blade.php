@component('mail::message')
<h1>{{ __('Buchung Mietcomputer') . ' – ' . $event->course->title }}</h1>
<p>{{ __('Guten Tag') }} {{ $user->fullname }}</p>
<p>{{ __('Gerne bestätigen wir die Buchung des Mietcomputers wie folgt:') }}</p>
<table class="content-table" cellpadding="0" cellspacing="0">
  <tr>
    <td width="120">{{ __('Buchung') }}</td>
    <td>{{ $booking->number }}</td>
  </tr>
  <tr>
    <td>{{ __('Kurs') }}</td>
    <td>{{ $event->course->title }}</td>
  </tr>
  <tr>
    <td>{{ __('Datum') }}</td>
    <td>{{ collect($event->dates->pluck('date_short')->all())->implode(', ') }}</td>
  </tr>
  <tr>
    <td>{{ __('Kosten') }}</td>
    <td>CHF {{ config('invoice.cost_rental') }} (exkl. MwSt.)</td>
  </tr>
</table>
@if ($rental_invoice)
<p>{!! __('Die Rechnung für den Mietcomputer findest Du im Anhang.<br>Falls Du die Rechnung lieber mit Kreditkarte bezahlen möchtest, dann klicke bitte auf den nachfolgenden Link.') !!}</p>
<p class="py-2x"><a href="{{ route(locale() . '.page.payment.overview', ['invoice' => $rental_invoice->uuid]) }}" target="_blank" class="button button-primary" style="text-decoration: none;"><strong>{{ __('Zahlung per Kreditkarte') }}</strong></a></p>
@else
<p>{{ __('Die Rechnung erhältst Du, sobald wir wissen, dass die Mindestanzahl Teilnehmende erreicht ist und der Kurs definitiv stattfinden wird.') }}</p>
@endif
<p>{{ __('Um diese Buchung zu annullieren, klicke bitte') }} <a href="{{ route(locale() . '.page.student.profile') }}" target="_blank" style="color: #000000; text-decoration: none;"><strong>{{ __('hier') }}</strong></a>.</p>
<p>{{ __('Bei Fragen stehen wir Dir gerne zur Verfügung.') }}</p>
@include('mail.partials.signature')
@endcomponent