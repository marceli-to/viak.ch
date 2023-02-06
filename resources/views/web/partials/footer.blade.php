@if (request()->routeIs('*.page.home'))
<footer class="site-footer">
  <div>
    <div class="sm:span-7" id="app-newsletter">
      <newsletter-form />
    </div>
    <div class="sm:span-4 start-9 mt-6x sm:mt-0">
      <h2>{{ __('Kontakt') }}</h2>
      <p>Visualisierungs-Akademie Schweiz GmbH<br>Limmatstrasse 291<br>CH-8005 Zürich<br>Schweiz</p>
      <p><a href='tel:+41435014040' title='{{ __('per Telefon') }}'>+41 43 501 40 40</a><br><a href='mailto:hallo@visualisierungs-akademie.ch' title='{{ __('per E-Mail') }}'>hallo@visualisierungs-akademie.ch</a></p>
      <h2>
        <a href="{{ localized_route('page.courses')}}" class="{{ request()->routeIs('page.course*') ? 'is-active' : '' }}" title="{{ __('Kurse') }}">
          {{ __('Kurse') }}
        </a>
      </h2>
      <h2>
        <a href="{{ localized_route('page.experts')}}" class="{{ request()->routeIs('page.experts') || request()->routeIs('page.expert') ? 'is-active' : '' }}" title="{{ __('Experten') }}">
          {{ __('Experten') }}
        </a>
      </h2>
    </div>
  </div>
</footer>
@endif
<script src="{{ mix('assets/js/global/newsletter.js') }}" type="text/javascript"></script>
<script src="{{ mix('assets/js/app.js') }}" type="text/javascript"></script>
</body>
<!-- made with ❤ by wbg.ch & marceli.to -->
</html>