@component('mail::message')
<h1>{{ __('Zugangsdaten') }}</h1>
<p>{{ __('Hallo') }} {{ $data->firstname }} {{ $data->name }}</p>
<p>{{ __('Es wurde ein Konto für dich eingerichtet. Um die Erstellung Deines Kontos abzuschliessen, müssen wir Deine E-Mail-Adresse verifizieren. Bitte klick auf folgenden Button:') }}</p>
<p><a href="{{ $confirmUrl }}" class="button button-primary">{{ __('E-Mail Bestätigen') }}</a></p>
<p><small>{{ __('Sollte der Button "E-Mail Bestätigen" nicht funktionieren, kopier bitte die untenstehende URL und fügen sie in die Adresszeile Deines Browses ein:') }}<br><span class="break-all">{{ $confirmUrl }}</span></small></p>
@include('mail.partials.signature')
@endcomponent