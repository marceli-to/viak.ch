@component('mail::message')
<h1>{{ __('Reminder') . ' – ' . $event->course->title }}</h1>
<p>{{ __('Der folgende Kurs wurde noch nicht bestätigt oder abgesagt:') }}</p>
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
    <td>{{ $event->experts_fullname_string }}
  </tr>
</table>
<p class="py-2x">
  <a href="{{ config('app.url') }}/dashboard/course/event/edit/{{ $event->uuid }}" class="button button-primary">{{ __('Kurs bearbeiten') }}</a>
</p>
@include('mail.partials.signature')
@endcomponent