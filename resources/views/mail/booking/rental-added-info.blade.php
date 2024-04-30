@component('mail::message')
<p>{{ __('Hallo') }}</p>
<p>{{ __('Für den Kurs') }} «{{ $booking->event->course->title }}» {{ __('wurde ein Mietcomputer gebucht') }}</p>
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
</table>
@include('mail.partials.signature')
@endcomponent