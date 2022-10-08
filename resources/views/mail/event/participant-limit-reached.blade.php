@component('mail::message')
<h1>{{'Max. Teilnehmerzahl erreicht – ' . $data->course->title }}</h1>
<p>{{ __('Die max. Teilnehmerzahl für den Kurs ') }} «{{ $data->course->title }}». {{ __('wurde erreicht.') }}</p>
<table class="content-table" cellpadding="0" cellspacing="0">
  <tr>
    <td width="120">{{ __('Kurs') }}</td>
    <td>{{ $data->course->title }}</td>
  </tr>
  <tr>
    <td>{{ __('Datum') }}</td>
    <td>{{ collect($data->dates->pluck('date_short')->all())->implode(', ') }}</td>
  </tr>
</table>
<p>[Link Dashboard Kurs]</p>
@include('mail.partials.signature')
@endcomponent