<li>
@auth
  <a href="{{ $route ? route($route) : '' }}" title="{{ __('Profil') }}">
    <span class="sm:hide">{{ __('Profil') }}</span>
    <span class="xs:hide icon-profile">
      @include('web.partials.icons.profile', ['class' => 'is-active'])
    </span>
  </a>
@endauth
@guest
  <a href="{{ route('login') }}" title="{{ __('Profil') }}">
    <span class="sm:hide">{{ __('Profil') }}</span>
    <span class="xs:hide icon-profile">
      @include('web.partials.icons.profile')
    </span>
  </a>
@endguest
</li>
