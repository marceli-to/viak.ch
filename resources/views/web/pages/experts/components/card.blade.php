<article class="card-teaser span-6 sm:span-4" data-touch>
  <a href="{{ route('page.expert', ['slug' => SlugHelper::make($user->fullname), 'user' => $user->uuid]) }}">
    <header>
      <h2 class="card__heading">{{ $user->fullname }}</h2>
    </header>
    <figure>
      <div>
        @if ($courses)
          <h3>{{ __('Kurse') }}:</h3>
          <div class="mb-4x sm:mb-6x">
            <ul>
              @foreach($courses as $course)
                <li>{{ $course }}</li>
              @endforeach
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