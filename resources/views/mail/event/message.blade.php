@component('mail::message')
<p><small><em>{{ $message->user->fullname }} ({{ $message->user->email }}) {{ __('hat folgende Nachricht gesendet:') }}</em></small></p>
{!! nl2br($message->body) !!}

<p><small>{{ __('Um diese Buchung zu annullieren, klicke bitte') }} <a href="{{ route('page.student.profile') }}" target="_blank" style="color: #000000; text-decoration: none;">{{ __('hier') }}</a>.<small></p>

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
    <td>{{ __('Ort') }}</td>
    <td>
      @if ($event->online)
       {{ __('Online') }}
      @else
        {{ $event->location->description }}
      @endif
    </td>
  </tr>
</table>
@include('mail.partials.signature')
@endcomponent