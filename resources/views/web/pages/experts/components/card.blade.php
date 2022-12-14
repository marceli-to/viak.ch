<article class="card-teaser span-6 sm:span-4" data-touch>
  <a href="{{ route(locale() . '.page.expert', ['slug' => SlugHelper::make($expert->fullname), 'user' => $expert->uuid]) }}">
    <header>
      <h2 class="card-teaser__heading">
        {{ $expert->fullname }}
      </h2>
    </header>
    <figure>
      <div>
        @if ($courses->count() > 0)
          <h3>{{ __('Kurse') }}:</h3>
          <div class="card-teaser__list">
            <ul>
              @foreach($courses as $course)
                <li>{{ $course }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <div class="card-teaser__more icon-arrow-right:after">
          {{ __('Weitere Informationen') }}
          @include('web.partials.icons.arrow-right')
        </div>
      </div>
      @if ($expert->teaserImage)
        <x-image :maxSizes="[0 => 700, 700 => 1100]" width="600" height="600" :image="$expert->teaserImage" ratio="1x1" :caption="$expert->fullname" />
      @else
        <img src="/media/viak-placeholder-teaser.png" height="600" width="600" class="is-responsive" alt="{{ $expert->fullname }}">
      @endif
    </figure>
  </a>
</article>