<article class="card-teaser span-6" data-touch>
  <a href="{{ route('page.course', ['slug' => $course->slug, 'course' => $course->uuid]) }}">
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
          <h3>{{ __('Übersicht') }}:</h3>
          <div class="mb-4x sm:mb-6x">
            <ul>
              <li>
                {{ __('Experte') }}: {{ $course->upcomingEvents()->first()->experts()->first()->fullname}}
              </li>
              <li>
                {{ __('ab') }} {{ date('d. F Y', strtotime($course->upcomingEvents()->first()->date)) }}
              </li>
              @if ($course->online)
                <li>
                  {{ __('Online Schulung') }}
                </li>
              @endif
              <li>
                CHF {{ $course->fee }}
              </li>
            </ul>
          </div>
        @endif
        <div>
          {{ __('Weitere Informationen') }}
        </div>
      </div>
      <img src="/media/dummy-{{rand(1,5)}}.png" class="is-responsive">
    </figure>
  </a>
</article>