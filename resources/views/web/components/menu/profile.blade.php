<li>
@auth
  <a href="{{ $route == 'page.admin.profile' ? '/dashboard/admin/profile' : $route }}" title="{{ __('Profil') }}">
    <span class="sm:hide">{{ __('Profil') }}</span>
    <span class="xs:hide icon-profile sm:mx-4x md:mx-8x">
      @include('web.partials.icons.profile', ['class' => 'is-active'])
    </span>
  </a>
@endauth
@guest
  <a href="{{ route('login') }}" title="{{ __('Profil') }}">
    <span class="sm:hide">{{ __('Profil') }}</span>
    <span class="xs:hide icon-profile sm:mx-4x md:mx-8x">
      @include('web.partials.icons.profile')
    </span>
  </a>
@endguest
</li>
