<article class="card-teaser span-6" data-touch>
  <a href="{{ route('page.course', ['slug' => $course->slug, 'course' => $course->uuid]) }}">
    <header>
      <div class="card-teaser__category">
        @if ($course->categories)
          @foreach($course->categories as $category)
            {{$loop->last ? $category->description : $category->description . ', '}}
          @endforeach
        @endif
      </div>
      <h2 class="card-teaser__heading">{{ $course->title }}</h2>
    </header>
    <figure>
      <div>
        @if ($course->hasUpcomingEvents())
          <h3>{{ __('Übersicht') }}:</h3>
          <div class="card-teaser__list">
            <ul>
              <li>
                {{ __('Experte') }}: {{ $course->upcomingEvents()->first()->experts()->first()->fullname}}
              </li>
              <li>
                {{ __('ab') }} {{ $course->upcomingEvents()->first()->date }}
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
        <div class="card-teaser__more icon-arrow-right:after">
          {{ __('Weitere Informationen') }}
          @include('web.partials.icons.arrow-right')
        </div>
      </div>
      @if ($course->teaserImage)
        <x-image :maxSizes="[0 => 700, 700 => 1100]" width="600" height="600" :image="$course->teaserImage" ratio="1x1" :caption="$course->title" />
      @else
        <img src="/media/viak-placeholder-teaser.png" height="600" width="600" class="is-responsive" alt="{{ $course->title }}">
      @endif
    </figure>
  </a>
</article>