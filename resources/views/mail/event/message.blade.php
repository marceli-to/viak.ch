@component('mail::message')
<em>{{ $message->user->fullname }} ({{ $message->user->email }}) {{ __('hat folgende Nachricht gesendet:') }}</em><br><br>
{!! $message->body !!}
<br><br>
<table class="content-table" cellpadding="0" cellspacing="0">
  <tr>
    <td width="140">{{ __('Kurs') }}</td>
    <td>{{ $event->course->title }}</td>
  </tr>
  <tr>
    <td>{{ __('Datum') }}</td>
    <td>{{ collect($event->dates->pluck('date_short')->all())->implode(', ') }}</td>
  </tr>
</table>
@include('mail.partials.signature')
@endcomponent