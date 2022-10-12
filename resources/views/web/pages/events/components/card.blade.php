<article class="stacked-list-event {{ $isBooked ? 'is-booked' : ''}}" data-touch>
  <div>
    <div class="stacked-list__col">
      <div class="sm:flex">
        @if ($isBooked || $bookmark)
          <div class="stacked-list__icon">
            @if ($isBooked)
              @include('web.partials.icons.checkmark')
            @else
              <bookmark-button event="{{ $event->uuid }}" bookmark="{{ $bookmark->uuid }}" />
            @endif
          </div>
        @else
          <div class="stacked-list__icon">
            @auth
              <bookmark-button event="{{ $event->uuid }}" :auth="true" />
            @endauth
            @guest
              <bookmark-button event="{{ $event->uuid }}" :auth="false" />
            @endguest
          </div>
        @endif
        <div>
          @if ($event->dates)
            <div>
              @if ($event->dates->count() > 1)
                @foreach($event->dates as $date)
                  <strong>{{ $date->date }}</strong><br>{{ $date->time_start }} – {{ $date->time_end }} Uhr<br>
                @endforeach
              @else
                @foreach($event->dates as $date)
                  <strong>{{ $date->date }}</strong><br>
                  {{ $date->time_start }} – {{ $date->time_end }} Uhr
                @endforeach
              @endif
            </div>
          @endif
        </div>
      </div>
    </div>
    <div class="stacked-list__col">
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
      @if ($event->experts)
        <div>
          mit 
          @foreach($event->experts as $expert)
            <a href="{{ route('page.expert', ['slug' => SlugHelper::make($expert->fullname), 'user' => $expert->uuid]) }}" title="{{ $expert->fullname }}">{{ $expert->fullname }}</a>@if (!$loop->last), @endif
          @endforeach
        </div>
      @endif
    </div>
    <div class="stacked-list__col stacked-list__col--action">
      <div>
        {{ $event->courseFee }}
      </div>
      <div class="stacked-list__action">
        @if (!$isBooked)
          <basket-button uuid="{{ $event->uuid }}" :exists="{{ $inBasket }}" />
        @else
          <a href="{{ route('page.student.profile') }}" title="Buchung verwalten" class="btn-primary is-outline">
            {{ __('Verwalten')}}
          </a>
        @endif
      </div>
    </div>
  </div>
</article>