<div class="site-header__title sm:hide">
  @if (request()->routeIs('page.course*'))
    <h1>{{ __('Kurse') }}</h1>
  @endif
  @if (request()->routeIs('page.expert*'))
    <h1>{{ __('Experten') }}</h1>
  @endif
</div>