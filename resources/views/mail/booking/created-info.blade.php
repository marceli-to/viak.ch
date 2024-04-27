@component('mail::message')
<p>{{ __('Hallo') }} {{ $user->firstname }}</p>
<p>{{ __('Für den Kurs') }} «{{ $booking->event->course->title }}» {{ __('ist eine neue Anmeldung eingegangen.') }}</p>
<table class="content-table" cellpadding="0" cellspacing="0">
  <tr>
    <td>{{ __('Student:in') }}</td>
    <td>{{ $booking->user->full_name }}</td>
  </tr>
  <tr>
    <td>{{ __('Kurs') }}</td>
    <td>{{ $booking->event->course->title }}</td>
  </tr>
  <tr>
    <td>{{ __('Datum') }}</td>
    <td>{{ collect($booking->event->dates->pluck('date_short')->all())->implode(', ') }}</td>
  </tr>
  @if ($booking->event->online)
    <tr>
      <td>{{ __('Ort') }}</td>
      <td>{{ __('online') }}</td>
    </tr>
  @else
    <tr>
      <td>{{ __('Ort') }}</td>
      <td>{{ $booking->event->location ? $booking->event->location->description : '' }}</td>
    </tr>
  @endif
</table>
@if ($recipient == 'expert')
<p>{{ __('Alle weitere Details findest du') }} <a href="{{ route(locale() . '.page.expert.profile.course.event', ['uuid' => $booking->event->uuid]) }}" target="_blank" style="color: #000000; text-decoration: none;"><strong>{{ __('hier') }}</strong></a>.</p>
@endif
@include('mail.partials.signature')
@endcomponent