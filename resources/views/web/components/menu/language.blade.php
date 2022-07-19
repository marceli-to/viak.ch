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