@component('mail::message')
@if ($type == 'min')
<h1>{{'Teilnehmerzahl erreicht – ' . $data->course->title }}</h1>
<p>{{ __('Die minimale Teilnehmerzahl für den Kurs ') }} «{{ $data->course->title }}». {{ __('wurde erreicht.') }}</p>
@endif
@if ($type == 'max')
<h1>{{'Teilnehmerzahl erreicht – ' . $data->course->title }}</h1>
<p>{{ __('Die maximale Teilnehmerzahl für den Kurs ') }} «{{ $data->course->title }}». {{ __('wurde erreicht.') }}</p>
@endif
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
{{-- <p>[Link Dashboard Kurs]</p> --}}
@include('mail.partials.signature')
@endcomponent