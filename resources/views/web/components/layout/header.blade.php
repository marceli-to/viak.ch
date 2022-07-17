<div class="site-header__title sm:hide">
  @if (request()->routeIs('page.course*'))
    <h1>{{ __('Kurse') }}</h1>
  @endif
  @if (request()->routeIs('page.expert*'))
    <h1>{{ __('Experten') }}</h1>
  @endif
  @if (request()->routeIs('login'))
    <h1>{{ __('Login') }}</h1>
  @endif
  @if (request()->routeIs('password.confirm'))
    <h1>{{ __('E-Mail bestätigen') }}</h1>
  @endif
  @if (request()->routeIs('password.email'))
    <h1>{{ __('E-Mail bestätigen') }}</h1>
  @endif
  @if (request()->routeIs('verification.notice'))
    <h1>{{ __('E-Mail verifizieren') }}</h1>
  @endif
  @if (request()->routeIs('password.update'))
    <h1>{{ __('Passwort berabeiten') }}</h1>
  @endif
  @if (request()->routeIs('password.request'))
    <h1>{{ __('Passwort vergessen') }}</h1>
  @endif
  @if (request()->routeIs('password.reset'))
    <h1>{{ __('Passwort zurücksetzen') }}</h1>
  @endif
  @if (request()->routeIs('register'))
    <h1>{{ __('Registrierung') }}</h1>
  @endif
  @if (request()->routeIs('page.role.select'))
    <h1>{{ __('Rolle wählen') }}</h1>
  @endif
  
</div>
