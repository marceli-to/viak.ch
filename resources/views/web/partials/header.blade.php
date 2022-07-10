@include('web.partials.head')
<header class="site-header">
  <div>
    <div class="sm:span-4">
      <a href="{{ route('page.home') }}" title="Home | {{env('APP_NAME')}}">
        @include('web.partials.icons.logo')
      </a>
    </div>
    <div class="sm:span-8">
      @include('web.partials.menu')
    </div>
  </div>
</header>