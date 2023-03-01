@component('mail::message')
<h1>{{ __('Bestätigung Account') }}</h1>
<p>{{ __('Guten Tag') }} {{ $data->firstname }} {{ $data->name }}</p>
<p>{{ __('Vielen Dank für Dein Interesse an der der Visualisierungs-Akademie Schweiz GmbH.') }}</p>
<p>{{ __('Um die Registration Deines Accounts abzuschliessen, musst Du noch Deine E-Mail-Adresse bestätigen. Klicke dafür bitte auf folgenden Button:') }}</p>
<p class="py-2x"><a href="{{ $verifyUrl }}" class="button button-primary">{{ __('E-Mail Bestätigen') }}</a></p>
<p>{{ __('Sobald Du das erledigt hast, kannst Du bei uns Deinen ersten Kurs buchen.') }}
@include('mail.partials.signature')
<p><small>{{ __('Sollte der Button "E-Mail Bestätigen" nicht funktionieren, kopier bitte die untenstehende URL und fügen sie in die Adresszeile Deines Browses ein:') }}<br><span class="break-all">{{ $verifyUrl }}</span></small></p>
@endcomponent