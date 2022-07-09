<nav class="site-menu js-menu">
  <div>
    <a href="{{ route('page.home') }}" target="_blank" title="Home | {{env('APP_NAME')}}" class="sm:hide">
      @include('web.partials.icons.logo')
    </a>
    <div>
      <ul>
        <li><a href="">Kurse</a></li>
        <li><a href="">Experten</a></li>
        <li><a href="">Kontakt</a></li>
        <li><a href="">Profil</a></li>
        <li><a href="">Warenkorb</a></li>
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