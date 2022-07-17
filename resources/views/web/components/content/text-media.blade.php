<article class="text-media {{ $reverse ? 'is-reverse' : '' }}">
  <figure class="text-media__visual">
    @if ($image)
      <img src="/media/{{$image}}" height="1000" width="1600">
    @endif
  </figure>
  <div class="text-media__content sm:grid-cols-12">
    <div class="sm:span-4">
      <header>
        @if ($title)
          <h1>{{ $title }}
        @endif
        @if ($subtitle)
          <h2>{{ $subtitle }}</h2>
        @endif
      </header>
    </div>
    <div class="content__text sm:span-8">
      @if ($text)
        {!! $text !!}
      @endif
    </div>
  </div>
</article>