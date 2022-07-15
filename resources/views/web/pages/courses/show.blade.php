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
    <div class="sm:grid-cols-12">
      <div class="mb-4x sm:mb-0 sm:span-4">
        <h3>Kursinhalt</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis repudiandae aliquam debitis? Exercitationem, iusto vitae ut voluptas ducimus ad sint alias impedit, fuga recusandae ab eligendi est tenetur explicabo eius.</p>
      </div>
      <div class="mb-4x sm:mb-0 sm:span-4">
        <h3>Methodik</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, iusto vitae ut voluptas ducimus ad sint alias impedit, eligendi est tenetur explicabo eius.</p>
      </div>
      <div class="mb-4x sm:mb-0 sm:span-4">
        <h3>Abschluss</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis repudiandae aliquam debitis? Fuga recusandae ab eligendi est tenetur explicabo eius.</p>
      </div>
    </div>
  </x-collapsible>

  @if ($course->upcomingEvents)
    <x-collapsible title="{{ __('Kurse') }}" :expanded="true">
      @foreach($course->upcomingEvents as $event)
        <div class="mb-6x">
          <div>
            @if ($event->dates)
              @foreach($event->dates as $date)
                <strong>{{ $date->date }}</strong><br>
                {{ $date->time_start }} – {{ $date->time_end }} Uhr<br>
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

  <x-collapsible title="{{ __('Weitere Informationen') }}" class="mt-24x">
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis repudiandae aliquam debitis? Exercitationem, iusto vitae ut voluptas ducimus ad sint alias impedit, fuga recusandae ab eligendi est tenetur explicabo eius.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, iusto vitae ut voluptas ducimus ad sint alias impedit, eligendi est tenetur explicabo eius.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis repudiandae aliquam debitis? Fuga recusandae ab eligendi est tenetur explicabo eius.</p>
  </x-collapsible>

  @if ($browse)
    <div class="content-list-item">
      <h2>{{ __('Weitere Kurse') }}</h2>
      <nav class="browse">
        <ul>
          <li>
            <a href="{{ route('page.course', ['slug' => $browse['prev']->slug, 'course' => $browse['prev']->uuid]) }}" title="{{ $browse['prev']->title }}">
              <span>{{ $browse['prev']->title }}</span>
              @include('web.partials.icons.arrow-left')
            </a>
          </li>
          <li>
            <a href="{{ route('page.course', ['slug' => $browse['next']->slug, 'course' => $browse['next']->uuid]) }}" title="{{ $browse['next']->title }}">
              <span>{{ $browse['next']->title }}</span>
              @include('web.partials.icons.arrow-right')
            </a>
          </li>
        </ul>
      </nav>
    </div>
  @endif
</section>



  

  

@endsection