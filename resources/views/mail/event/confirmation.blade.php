@component('mail::message')
<h1>{{ __('Kursbestätigung') . ' – ' . $event->course->title }}</h1>
@if ($recipient == 'student')
<p>{{ __('Guten Tag') }} {{ $user->fullname }}</p>
@if ($event->free_of_charge)
<p>{{ __('Hiermit bestätigen wir die Durchführung des oben erwähnten Events:') }}</p>
@else
<p>{{ __('Hiermit bestätigen wir die Durchführung des oben erwähnten Kurses:') }}</p>
@endif
<table class="content-table" cellpadding="0" cellspacing="0">
  <tr>
    <td width="120">{{ __('Buchung') }}</td>
    <td>{{ $booking->number }}</td>
  </tr>
  @if ($event->free_of_charge)
    <tr>
      <td>{{ __('Event') }}</td>
      <td>{{ $event->course->title }}</td>
    </tr>
  @else
    <tr>
      <td>{{ __('Kurs') }}</td>
      <td>{{ $event->course->title }}</td>
    </tr>
  @endif
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
  <tr>
    <td>{{ __('Kosten') }}</td>
    <td>
      @if ($event->free_of_charge)
        {{ __('kostenlos') }}
      @else
        CHF {{ $event->courseFee - $booking->discount_amount }}
      @endif
    </td>
  </tr>
</table>
@if ($invoice)
<p>{!! __('Die Rechnung für die Kurskosten findest Du im Anhang.<br>Falls Du die Rechnung lieber mit Kreditkarte bezahlen möchtest, dann klicke bitte auf den nachfolgenden Link.') !!}</p>
<p class="py-2x"><a href="{{ route(locale() . '.page.payment.overview', ['invoice' => $invoice->uuid]) }}" target="_blank" class="button button-primary" style="text-decoration: none;"><strong>{{ __('Zahlung per Kreditkarte') }}</strong></a></p>
@endif
@if ($rental_invoice)
<p>{!! __('Die Rechnung für den Mietcomputer findest Du ebenfalls im Anhang.<br>Falls Du die Rechnung lieber mit Kreditkarte bezahlen möchtest, dann klicke bitte auf den nachfolgenden Link.') !!}</p>
<p class="py-2x"><a href="{{ route(locale() . '.page.payment.overview', ['invoice' => $rental_invoice->uuid]) }}" target="_blank" class="button button-primary" style="text-decoration: none;"><strong>{{ __('Zahlung per Kreditkarte') }}</strong></a></p>
@endif
<p>{{ __('Bei Fragen stehen wir Dir gerne zur Verfügung.') }}</p>
<p>{{ __('Möchtest Du weitere Schulungen besuchen? Verwalte Deine Kurse und Deine persönlichen Daten bequem und einfach unter:') }} <a href="{{ route(locale() . '.page.student.profile') }}" target="_blank" style="color: #000000; text-decoration: none; font-weight:bold"><strong>visualisierungs-akademie.ch/profil</strong></a></p>
@endif

@if ($recipient == 'expert')
<p>{{ __('Sali') }} {{ $user->firstname }}</p>
<p>{{ __('Hiermit bestätigen wir die Durchführung des oben erwähnten Kurses:') }}</p>
<table class="content-table" cellpadding="0" cellspacing="0">
  <tr>
    <td width="120">{{ __('Kurs') }}</td>
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
</table>
<p>{{ __('Weitere Informationen zu diesem Kurs findest Du ') }} <a href="{{ route('de.page.expert.profile.course.event', ['uuid' => $event->uuid]) }}" target="_blank" style="color: #000000; text-decoration: none;"><strong>{{ __('hier') }}</strong></a>.</p>
<p>{{ __('Wende Dich bei Fragen doch bitte umgehend an uns.') }}</p>
@endif
@include('mail.partials.signature')
@endcomponent