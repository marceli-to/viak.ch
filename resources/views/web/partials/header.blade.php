@include('web.partials.head')
<header class="site-header">
  <div>
    <a href="{{ route('page.home') }}" target="_blank" title="Home | {{env('APP_NAME')}}">
      @include('web.partials.icons.logo')
    </a>
    @include('web.partials.menu')
  </div>
</header>