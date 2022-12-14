@include('web.partials.head')
<header class="site-header">
  <div>
    <div class="sm:span-4">
      <a href="{{ localized_route('page.home') }}" title="Home | {{env('APP_NAME')}}" class="{{ !request()->routeIs('*.page.home') ? 'xs:hide': '' }}">
        @include('web.partials.icons.logo')
      </a>
      {{-- mobile header for all pages except home --}}
      @if (!request()->routeIs('page.home'))
        <div class="site-header__title sm:hide">
          @if(trim($__env->yieldContent('page_title')))
            <h1>{{ trim($__env->yieldContent('page_title')) }}</h1>
          @endif
        </div>
      @endif
    </div>
    <div class="sm:span-8">
      @include('web.partials.menu')
    </div>
  </div>
</header>