@extends('web.layout.frontend')
@section('content')
<section class="content">
  <x-article-text-media 
    image="viak-keyvisual-home.jpg" 
    title="{{ $course->title }}"
    subtitle="{{ $course->subtitle }}" 
    text="{{ $course->text }}"
    :reverse="false"
  />
</section>
<section class="content">
  <x-collapsible title="{{ __('Facts') }}">
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis repudiandae aliquam debitis? Exercitationem, iusto vitae ut voluptas ducimus ad sint alias impedit, fuga recusandae ab eligendi est tenetur explicabo eius.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, iusto vitae ut voluptas ducimus ad sint alias impedit, eligendi est tenetur explicabo eius.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis repudiandae aliquam debitis? Fuga recusandae ab eligendi est tenetur explicabo eius.</p>
  </x-collapsible>
  @if ($course->upcomingEvents)
    <x-collapsible title="{{ __('Kurse') }}">
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
    </x-collapsible>
  @endif

</section>



  

  

@endsection