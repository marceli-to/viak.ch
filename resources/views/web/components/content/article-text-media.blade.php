<article class="content-text-media {{ $reverse ? 'is-reverse' : '' }}">
  <figure class="text-media__visual">
    @if ($image)
      <img src="/media/{{$image}}" height="1000" width="1600" alt="{{ $title }}">
    @endif
  </figure>
  <div class="text-media__body">
    <aside>
      @if ($title)
        <h1>{{ $title }}</h1>
      @endif
      @if ($subtitle)
        <h2>{{ $subtitle }}</h2>
      @endif
    </aside>
    <div>
      @if ($text)
        {!! $text !!}
      @endif
    </div>
  </div>
</article>