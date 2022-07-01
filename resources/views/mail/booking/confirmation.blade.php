@component('mail::message')
<h1>Event Booking Confirmation «{{$data->title}}»</h1>
<p>Guten Tag</p>
<p>Freundliche Grüsse<br><br>{{ env('APP_NAME') }}</p>
@endcomponent