@include('web.partials.head')
<header class="site-header">
  <div>
    <div class="sm:span-4">
      <a href="{{ route('page.home') }}" title="Home | {{env('APP_NAME')}}" class="{{ !request()->routeIs('page.home') ? 'xs:hide': '' }}">
        @include('web.partials.icons.logo')
      </a>
      @if (!request()->routeIs('page.home'))
        <x-header />
      @endif
    </div>
    <div class="sm:span-8">
      @include('web.partials.menu')
    </div>
  </div>
</header>