@auth
  @if (auth()->user()->hasMultipleRoles())
    @if (session('user-selected-role') && session('user-selected-role')->key == 'student')
      <li>
        <a href="{{ route('page.student.profile') }}" title="{{ __('Profil bearbeiten') }}">
          <span class="sm:hide">{{ __('Profil') }}</span>
          <span class="xs:hide icon-profile">
            @include('web.partials.icons.profile')
          </span>
        </a>
      </li>
    @endif
  @elseif (auth()->user()->hasRole(\App\Models\Role::find(\App\Models\Role::STUDENT)))
    <li>
      <a href="{{ route('page.student.profile') }}" title="{{ __('Profil bearbeiten') }}">
        <span class="sm:hide">{{ __('Profil') }}</span>
        <span class="xs:hide icon-profile">
          @include('web.partials.icons.profile')
        </span>
      </a>
    </li>
  @else
    <li>
      <a href="" title="{{ __('Profil') }}">
        <span class="sm:hide">{{ __('Profil') }}</span>
        <span class="xs:hide icon-profile">
          @include('web.partials.icons.profile')
        </span>
      </a>
    </li>
  @endif
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