@component('mail::message')
<h1>{{ __('Bestätigung Anmeldung') }}</h1>
<p>{{ __('Hallo') }} {{ $data->firstname }} {{ $data->name }}</p>
<p>{{ __('Vielen Dank für deine Anmeldung bei der ' . env('APP_NAME') . '.') }}</p>
<p>{{ __('Um deine Anmeldung abzuschliessen, müssen wir deine E-Mail-Adresse verifizieren. Bitte klick auf folgenden Button:') }}</p>
<p><a href="{{ $verifyUrl }}" class="button button-primary">{{ __('E-Mail Bestätigen') }}</a></p>
@include('mail.partials.signature')
<p><small>{{ __('Sollte der Button "E-Mail Bestätigen" nicht funktionieren, kopier bitte die untenstehende URL und fügen sie in die Adresszeile deines Browses ein:') }}<br><span class="break-all">{{ $verifyUrl }}</span></small></p>
@endcomponent