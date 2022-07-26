<article class="stacked-list-event" data-touch>
  <div>
    <div class="stacked-list__col">
      <div class="{{ $state ? 'sm:flex' : '' }}">
        @if ($state == 'bookmark')
          <div class="stacked-list__icon">
            @include('web.partials.icons.heart')
          </div>
        @endif
        @if ($state == 'booked')
          <div class="stacked-list__icon">
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
    </div>
    <div class="stacked-list__col stacked-list__col--action">
      <div>
        {{ $event->courseFee }}
      </div>
      <div class="stacked-list__action">
        @if (!$isBooked)
          <basket-button uuid="{{ $event->uuid }}" :exists="{{ $inBasket }}" />
        @else
          <div>
            <em>{{ __('bereits gebucht')}}</em>
          </div>
        @endif
      </div>
    </div>
  </div>
</article>