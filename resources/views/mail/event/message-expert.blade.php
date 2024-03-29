@component('mail::message')
<p><small><em>{{ $message->user->fullname }} ({{ $message->user->email }}) {{ __('hat folgende Nachricht gesendet:') }}</em></small></p>
{!! $message->body !!}
@if ($message->files->count() > 0)
  <div>Anhänge</div>
  @foreach($message->files as $file)
    <div>
      <a href="{{ asset('storage/uploads/' . $file->name) }}" target="_blank">
        – {{ $file->description ? $file->description . ' ('. $file->name .')' : $file->name }} 
      </a>
    </div>
  @endforeach
@endif
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
       {{ __('Onlinekurs') }}
      @else
        {{ $event->location->description }}
      @endif
    </td>
  </tr>
</table>
@include('mail.partials.signature')
@endcomponent