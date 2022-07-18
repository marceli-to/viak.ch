<nav class="site-menu js-menu">
  <div>
    <a href="{{ route('page.home') }}" title="Home | {{env('APP_NAME')}}" class="sm:hide">
      @include('web.partials.icons.logo')
    </a>
    <div class="site-menu__main">
      <ul>
        <li>
          <a href="{{ route('page.courses')}}" class="{{ request()->routeIs('page.course*') ? 'is-active' : '' }}" title="{{ __('Kurse') }}">
            {{ __('Kurse') }}
          </a>
        </li>
        <li>
          <a href="{{ route('page.experts')}}" class="{{ request()->routeIs('page.expert*') ? 'is-active' : '' }}" title="{{ __('Experten') }}">
            {{ __('Experten') }}
          </a>
        </li>
        <li>
          <a href="">{{ __('Kontakt') }}</a>
        </li>
      </ul>
      <ul>
        @auth
          <li>
            <a href="" title="{{ __('Profil') }}">
              <span class="sm:hide">{{ __('Profil') }}</span>
              <span class="xs:hide icon-profile">
                @include('web.partials.icons.profile')
              </span>
            </a>
          </li>
        @endauth
        @guest
          <li>
            <a href="{{ route('login') }}" title="{{ __('Profil') }}">
              <span class="sm:hide">{{ __('Profil') }}</span>
              <span class="xs:hide icon-profile">
                @include('web.partials.icons.profile')
              </span>
            </a>
          </li>
        @endguest
        <li class="sm:hide">
          <a href="" title="{{ __('Warenkorb') }}">{{ __('Warenkorb') }}</a>
        </li>
        <li class="language-switcher sm:hide">
          <a href="{{ app()->getLocale() == 'de' ? '/en' : '/de' }}">
            @if (app()->getLocale() == 'de')
              {{ __('English') }}
            @else
              {{ __('Deutsch') }}
            @endif
          </a>
        </li>
        <li class="language-switcher xs:hide">
          <a href="/de" title="{{ __('Deutsch') }}">DE</a>
          <span>&nbsp;/&nbsp;</span>
          <a href="/en" title="{{ __('English') }}">EN</a>
        </li>
      </ul>
    </div>
  </div>
  <footer class="site-menu__footer">
    <div>
      <a href="mailto:kontakt@viak.ch" class="icon-mail" target="_blank" title="{{ __('Kontakt') }}">
        @include('web.partials.icons.mail')
      </a>
      <a href="https://instagram.com" class="icon-instagram" target="_blank" title="{{ __('Viak auf Instagram') }}">
        @include('web.partials.icons.instagram')
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