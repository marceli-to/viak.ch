<nav class="site-menu js-menu">
  <div>
    <a href="{{ localized_route('page.home') }}" title="Home | {{ env('APP_NAME') }}" class="sm:hide">
      @include('web.partials.icons.logo')
    </a>
    <div class="site-menu__main">
      <ul>
        <li>
          <a href="{{ localized_route('page.courses')}}" class="{{ request()->routeIs('*.page.course*') ? 'is-active' : '' }}" title="{{ __('Kurse') }}">
            {{ __('Kurse') }}
          </a>
        </li>
        <li>
          <a href="{{ localized_route('page.experts')}}" class="{{ request()->routeIs('*.page.experts') || request()->routeIs('page.expert') ? 'is-active' : '' }}" title="{{ __('Experten') }}">
            {{ __('Experten') }}
          </a>
        </li>
        <li>
          <a href="{{ localized_route('page.contact') }}" class="{{ request()->routeIs('*.page.contact') ? 'is-active' : '' }}">{{ __('Kontakt') }}</a>
        </li>
      </ul>
      <ul>
        <x-menu-item-basket />
        <x-menu-item-profile />
        {{-- <x-menu-item-language /> --}}
      </ul>
    </div>
  </div>
  <footer class="site-menu__footer">
    <div>
      <a href="mailto:hallo@visualisierungs-akademie.ch" class="icon-mail" target="_blank" title="{{ __('Kontakt') }}">
        @include('web.partials.icons.mail')
      </a>
      <a href="https://www.instagram.com/viak.ch/" class="icon-instagram" target="_blank" title="{{ __('Visualisierungs-Akademie auf Instagram') }}">
        @include('web.partials.icons.instagram')
      </a>
      <a href="https://www.facebook.com/ViAkSchweiz" class="icon-facebook" target="_blank" title="{{ __('Visualisierungs-Akademie auf Facebook') }}">
        @include('web.partials.icons.facebook')
      </a>
    </div>
    <div>
      <a href="javascript:;" title="Menü" class="icon-menu icon-menu__cross js-menu-btn-hide" title="{{ __('Menü anzeigen') }}">
        @include('web.partials.icons.cross', ['size' => 'large'])
      </a>
    </div>
  </footer>
</nav>
<a href="javascript:;" title="Menü" class="icon-menu icon-menu__burger js-menu-btn-show" title="{{ __('Menu verbergen') }}">
  @include('web.partials.icons.burger')
</a>