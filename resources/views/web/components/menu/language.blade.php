@auth
  @if (auth()->user()->isAdmin())
    <li class="language-switcher sm:hide">
      <a href="{{ app()->getLocale() == 'de' ? current_route('en') : current_route('de') }}">
        @if (app()->getLocale() == 'de')
          {{ __('English') }}
        @else
          {{ __('Deutsch') }}
        @endif
      </a>
    </li>
    <li class="language-switcher sm:ml-4x md:ml-8x xs:hide">
      <a href="{{ current_route('de') }}" title="{{ __('Deutsch') }}">DE</a>
      <span>&nbsp;/&nbsp;</span>
      <a href="{{ current_route('en') }}" title="{{ __('English') }}">EN</a>
    </li>
  @endif
@endauth