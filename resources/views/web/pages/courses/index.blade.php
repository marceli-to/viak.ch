@extends('web.layout.frontend')
@section('content')
<section id="app-courses">
<course-filter>
  @if ($courses)
    <div class="grid-cols-12">
      @foreach($courses as $course)
        <article class="card-teaser span-6">
          <a href="{{ route('page.course', ['course' => $course->slug]) }}">
            <header>
              <div class="card__category">
                @if ($course->categories)
                  @foreach($course->categories as $category)
                    {{$loop->last ? $category->description : $category->description . ', '}}
                  @endforeach
                @endif
              </div>
              <h2 class="card__heading">{{ $course->title }}</h2>
            </header>
            <figure>
              <div>
                @if ($course->hasUpcomingEvents())
                  <h3>Übersicht:</h3>
                  <ul>
                    <li>
                      Experte: {{ $course->upcomingEvents()->first()->experts()->first()->fullname}}
                    </li>
                    <li>
                      ab {{ date('d. F Y', strtotime($course->upcomingEvents()->first()->date)) }}
                    </li>
                    @if ($course->online)
                      <li>
                        Online Schulung
                      </li>
                    @endif
                    <li>
                      CHF {{ $course->fee }}
                    </li>
                  </ul>
                @endif
                <p class="mt-4x sm:mt-6x">Weitere Informationen</p>
              </div>
              <img src="/media/dummy-{{rand(1,5)}}.png" class="is-responsive">
            </figure>
          </a>
        </article>
      @endforeach
    </div>
  @endif
</course-filter>
</section>
<script src="{{ mix('assets/js/filter.js') }}" type="text/javascript"></script>
@endsection