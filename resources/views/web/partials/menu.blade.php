<nav class="site-menu js-menu">
  <div>
    <a href="{{ route('page.home') }}" target="_blank" title="Home | {{env('APP_NAME')}}" class="sm:hide">
      @include('web.partials.icons.logo')
    </a>
    <div class="site-menu__main">
      <ul>
        <li>
          <a href="">{{ __('Kurse') }}</a>
        </li>
        <li>
          <a href="">{{ __('Experten') }}</a>
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
          <a href="">{{ __('Warenkorb') }}</a>
        </li>
        <li class="sm:hide">
          <a href="">
            @if (app()->getLocale() == 'de')
              {{ __('English') }}
            @else
              {{ __('Deutsch') }}
            @endif
          </a>
        </li>
        <li class="language-switcher xs:hide">
          <a href="">DE</a>
          <span>&nbsp;/&nbsp;</span>
          <a href="">EN</a>
        </li>
      </ul>
    </div>
  </div>
  <footer class="site-menu__footer">
    <div>
      <a href="mailto:kontakt@viak.ch" class="icon-mail" target="_blank">
        @include('web.partials.icons.mail')
      </a>
      <a href="https://instagram.com" class="icon-instagram" target="_blank">
        @include('web.partials.icons.instagram')
      </a>
    </div>
    <div>
      <a href="javascript:;" title="Menü" class="icon-menu icon-menu__cross js-menu-btn-hide">
        @include('web.partials.icons.cross')
      </a>
    </div>
  </footer>
</nav>
<a href="javascript:;" title="Menü" class="icon-menu icon-menu__burger js-menu-btn-show">
  @include('web.partials.icons.burger')
</a>