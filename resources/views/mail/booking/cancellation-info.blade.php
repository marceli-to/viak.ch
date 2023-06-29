@component('mail::message')
<p>{{ __('Hallo') }} {{ $user->firstname }}</p>
<p>{{ __('Vom Kurs') }} «{{ $event->course->title }}» {{ __('hat sich jemand abgemeldet.') }}</p>
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
@include('mail.partials.signature')
@endcomponent