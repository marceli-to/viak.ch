@component('mail::message')
@if ($type == 'belowMin')
<h1>{{'Min. Teilnehmerzahl unterschritten – ' . $event->course->title }}</h1>
<p>{{ __('Die minimale Teilnehmerzahl für den Kurs ') }} «{{ $event->course->title }}». {{ __('wurde unterschritten.') }}</p>
@endif
@if ($type == 'min')
<h1>{{'Min. Teilnehmerzahl erreicht – ' . $event->course->title }}</h1>
<p>{{ __('Die minimale Teilnehmerzahl für den Kurs ') }} «{{ $event->course->title }}». {{ __('wurde erreicht.') }}</p>
@endif
@if ($type == 'max')
<h1>{{'Max. Teilnehmerzahl erreicht – ' . $event->course->title }}</h1>
<p>{{ __('Die maximale Teilnehmerzahl für den Kurs ') }} «{{ $event->course->title }}». {{ __('wurde erreicht.') }}</p>
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
    <td>{{ __('Experten') }}</td>
    <td>{{ collect($event->experts->pluck('fullname')->all())->implode(', ') }}
  </tr>
</table>
<p class="py-2x">
  <a href="{{ env('APP_URL') }}/dashboard/course/event/edit/{{ $event->uuid }}" class="button button-primary">{{ __('Kurs bearbeiten') }}</a>
</p>
@include('mail.partials.signature')
@endcomponent