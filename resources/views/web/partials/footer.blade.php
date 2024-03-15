@if (request()->routeIs('*.page.home'))
<footer class="site-footer">
  <div>
    <div class="sm:span-7" id="app-newsletter">
      <newsletter-form />
    </div>
    <div class="sm:span-4 start-9 mt-6x sm:mt-0">
      <h2>{{ __('Kontakt') }}</h2>
      <p>Visualisierungs-Akademie Schweiz GmbH<br>Limmatstrasse 291<br>CH-8005 Zürich</p>
      <p>
        <a href='tel:+41435014040' title='{{ __('per Telefon') }}'>+41 43 501 40 40</a><br><a href='mailto:hallo@visualisierungs-akademie.ch' title='{{ __('per E-Mail') }}'>hallo@visualisierungs-akademie.ch</a>
      </p>  
      <div class="flex">
        <a href="https://www.instagram.com/viak.ch/" class="mr-3x" target="_blank" title="{{ __('Visualisierungs-Akademie auf Instagram') }}" rel="noopener">
          Instagram
        </a>
        <a href="https://www.facebook.com/ViAkSchweiz" target="_blank" title="{{ __('Visualisierungs-Akademie auf Facebook') }}" rel="noopener">
          Facebook
        </a>
      </div>
    </div>
  </div>
</footer>
<script src="{{ mix('assets/js/global/newsletter.js') }}" defer></script>
@endif
<script src="{{ mix('assets/js/app.js') }}"></script>
@production
{{-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-M3L7WVP');</script> --}}
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('consent', 'default', {
    'ad_storage': 'denied',
    'analytics_storage': 'denied'
  });
</script>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-M3L7WVP');</script>
<script type="text/plain" data-category="analytics">gtag('consent', 'update', {'analytics_storage': 'granted'});</script>
<script type="text/plain" data-category="!analytics">gtag('consent', 'update', {'analytics_storage': 'denied'});</script>
<script type="text/plain" data-category="ads">gtag('consent', 'update', {'ad_storage': 'granted'});</script>
<script type="text/plain" data-category="!ads">gtag('consent', 'update', {'ad_storage': 'denied'});</script>
<script type="module" src="/assets/cookieconsent/cookieconsent-init.js?t={{ time() }}"></script>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M3L7WVP" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
@endproduction
</body>
<!-- made with ❤ by wbg.ch & marceli.to -->
</html>