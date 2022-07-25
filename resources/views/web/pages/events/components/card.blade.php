<article class="card-course-event" data-touch>
  <div>
    <div class="card__col">
      <div class="{{ $state ? 'sm:flex' : '' }}">
        @if ($state == 'bookmark')
          <div class="card__icon">
            @include('web.partials.icons.heart')
          </div>
        @endif
        @if ($state == 'booked')
          <div class="card__icon">
            @include('web.partials.icons.checkmark')
          </div>
        @endif
        <div>
          @if ($event->dates)
            <div>
              @if ($event->dates->count() > 1)
                @foreach($event->dates as $date)
                  <strong>{{ $date->dateShort }}</strong>, {{ $date->time_start }} – {{ $date->time_end }} Uhr<br>
                @endforeach
              @else
                @foreach($event->dates as $date)
                  <strong>{{ $date->dateShort }}</strong><br>
                  {{ $date->time_start }} – {{ $date->time_end }} Uhr
                @endforeach
              @endif
            </div>
          @endif
          @if ($event->experts)
            <div>
              mit 
              @foreach($event->experts as $expert)
                <a href="{{ route('page.expert', ['slug' => SlugHelper::make($expert->fullname), 'user' => $expert->uuid]) }}" title="{{ $expert->fullname }}">{{ $expert->fullname }}</a>@if (!$loop->last), @endif
              @endforeach
            </div>
          @endif
        </div>
      </div>
    </div>
    <div class="card__col">
      @if ($event->online)
        {{ __('Online') }}
      @else
        @if ($event->location->map)
          <a href="{{ $event->location->map }}" target="_blank" title="{{ __('Karte anzeigen') }}">
            {{ $event->location->description }}
          </a>
        @else
          {{ $event->location->description }}
        @endif
      @endif
    </div>
    <div class="card__col card__col--action">
      <div>
        @if ($event->fee)
          CHF {{ $event->fee }}
        @else
          CHF {{ $event->course->fee }}
        @endif
      </div>
      <div class="card__action">
        <basket-button uuid="{{ $event->uuid }}" :exists="{{ $exists }}" />
      </div>
    </div>
  </div>
</article>