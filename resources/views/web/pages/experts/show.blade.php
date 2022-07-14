@extends('web.layout.frontend')
@section('content')
<x-article-text-media 
  image="viak-keyvisual-home.jpg" 
  title="{{ $expert->fullname }}"
  subtitle="" 
  text=""
  :reverse="false"
/>
{{-- @if ($course->upcomingEvents)
  @foreach($course->upcomingEvents as $event)
    <div class="mb-6x">
      <div>
        @if ($event->dates)
          @foreach($event->dates as $date)
            <strong>{{ $date->date }}</strong><br>
            {{ $date->time_start }} – {{ $date->time_end }} Uhr
          @endforeach
        @endif
        @if ($event->experts)
        <div>
          mit {{ collect($event->experts->pluck('fullname')->all())->implode(', ') }}
        </div>
        @endif
      </div>
    </div>
  @endforeach
@endif --}}
@endsection