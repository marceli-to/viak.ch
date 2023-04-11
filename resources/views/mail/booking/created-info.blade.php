@component('mail::message')
<p>{{ __('Hallo') }} {{ $user->firstname }}</p>
<p>{{ __('Für den Kurs') }} «{{ $event->course->title }}» {{ __('ist eine neue Anmeldung eingegangen.') }}</p>
<table class="content-table" cellpadding="0" cellspacing="0">
  <tr>
    <td>{{ __('Kurs') }}</td>
    <td>{{ $event->course->title }}</td>
  </tr>
  <tr>
    <td>{{ __('Datum') }}</td>
    <td>{{ collect($event->dates->pluck('date_short')->all())->implode(', ') }}</td>
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
</table>
@if ($recipient == 'expert')
<p>{{ __('Alle weitere Details findest du') }} <a href="{{ route(locale() . '.page.expert.profile.course.event', ['uuid' => $event->uuid]) }}" target="_blank" style="color: #000000; text-decoration: none;"><strong>{{ __('hier') }}</strong></a>.</p>
@endif
@include('mail.partials.signature')
@endcomponent