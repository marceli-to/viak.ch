@component('mail::message')
<h1>Event Booking «{{$data->title}}»</h1>
<p>Guten Tag</p>
<p>Freundliche Grüsse<br><br>{{ env('APP_NAME') }}</p>
@endcomponent