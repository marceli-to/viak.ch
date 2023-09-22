<article class="stacked-list-event {{ $styles }}" data-touch>
  <div>
    <div class="stacked-list__col">
      <div class="sm:flex">
        @if ($hasBooking || $bookmark || $isFullyBooked)
          <div class="stacked-list__icon">
            @if ($hasBooking)
              @include('web.partials.icons.checkmark')
            @elseif ($isFullyBooked)
              @include('web.partials.icons.heart', ['active' => false])
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
                  <strong>{{ $date->date_long }}</strong><br>{{ $date->time_start }} – {{ $date->time_end }} Uhr<br>
                @endforeach
              @else
                @foreach($event->dates as $date)
                  <strong>{{ $date->date_long }}</strong><br>
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
        {{ __('Onlinekurs') }}
      @else
        @if ($event->location->map)
          Kursort:<br class="hide sm:block">
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
            <a href="{{ route(locale() . '.page.expert', ['slug' => SlugHelper::make($expert->fullname), 'user' => $expert->uuid]) }}" title="{{ $expert->fullname }}">{{ $expert->fullname }}</a>@if (!$loop->last), @endif
          @endforeach
        </div>
      @endif
      @if ($event->registration_until && !$hasBooking && !$isFullyBooked)
        <div>
          <em class="text-xsmall">Anmeldung möglich bis {{ $event->registration_until_str }}</em>
        </div>
      @endif
    </div>
    <div class="stacked-list__col stacked-list__col--action">
      <div>
        {{ $event->courseFee }}
      </div>
      <div class="stacked-list__action">

        @if ($isFullyBooked)

          @if ($hasBooking)
            <a href="{{ route(locale() . '.page.student.profile') }}" title="Buchung verwalten" class="btn-primary is-outline">
              {{ __('Verwalten')}}
            </a>
          @else
            <div class="text-small align-right text-danger pl-4x">
              <em>{{ __('Kurs ist ausgebucht') }}</em>
            </div>
          @endif
        @else
          @if (!$hasBooking)
            <basket-button uuid="{{ $event->uuid }}" :exists="{{ $inBasket }}" />
          @else
            <a href="{{ route(locale() . '.page.student.profile') }}" title="Buchung verwalten" class="btn-primary is-outline">
              {{ __('Verwalten')}}
            </a>
          @endif
        @endif
      </div>
    </div>
  </div>
</article>