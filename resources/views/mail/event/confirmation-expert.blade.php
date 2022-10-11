@component('mail::message')
<h1>{{ __('Kursbestätigung') . ' – ' . $event->course->title }}</h1>
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
    <td>{{ collect($event->experts->pluck('fullname')->all())->implode(', ') }}
  </tr>
</table>
<p>{{ __('Weitere Informationen zu diese Kurs findest du ') }} <a href="{{ route('page.expert.profile.course.event', ['uuid' => $event->uuid]) }}" target="_blank" style="color: #000000; text-decoration: none;"><strong>{{ __('hier') }}</strong></a>.</p>
@include('mail.partials.signature')
@endcomponent