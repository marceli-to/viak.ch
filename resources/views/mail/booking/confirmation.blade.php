@component('mail::message')
<h1>{{ __('Buchungsbestätigung') . ' – ' . $event->course->title }}</h1>
<p>{{ __('Guten Tag') }} {{ $user->fullname }}</p>
@if ($event->free_of_charge)
<p>{{ __('Vielen Dank für Deine Anmeldung für den Event') }} «{{ $event->course->title }}». {{ __('Gerne bestätigen wir Deine Anmeldung wie folgt:') }}</p>
@else
<p>{{ __('Vielen Dank für Deine Anmeldung für den Kurs') }} «{{ $event->course->title }}». {{ __('Gerne bestätigen wir Deine Anmeldung wie folgt:') }}</p>
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
        CHF {{ $event->courseFee }}
      @endif
    </td>
  </tr>
  @if ($booking->has_rental)
    <tr>
      <td>{{ __('Mietcomputer') }}</td>
      <td>gebucht</td>
    </tr>
  @endif
</table>
@if ($event->free_of_charge)
<p>{{ __('Die definitive Einladung für den Event erhältst Du, sobald wir wissen, dass die Mindestanzahl Teilnehmende erreicht ist und der Event definitiv stattfinden wird.') }}</p>
@else
<p>{{ __('Die Rechnung sowie die definitive Einladung für den Kurs erhältst Du, sobald wir wissen, dass die Mindestanzahl Teilnehmende erreicht ist und der Kurs definitiv stattfinden wird.') }}</p>
@endif
<p>{{ __('Um diese Buchung zu annullieren, klicke bitte') }} <a href="{{ route(locale() . '.page.student.profile') }}" target="_blank" style="color: #000000; text-decoration: none;"><strong>{{ __('hier') }}</strong></a>.</p>
<p>{{ __('Bei Fragen stehen wir Dir gerne zur Verfügung.') }}</p>
@include('mail.partials.signature')
<p class="small">{{ __('Möchtest Du weitere Schulungen besuchen? Verwalte Deine Kurse und Deine persönlichen Daten bequem und einfach unter:') }} <a href="{{ route(locale() . '.page.student.profile') }}" target="_blank" style="color: #000000; text-decoration: none; font-weight:bold"><strong>visualisierungs-akademie.ch/profil</strong></a></p>
@endcomponent