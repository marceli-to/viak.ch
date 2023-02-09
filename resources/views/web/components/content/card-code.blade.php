<article class="card-code">
  <div>
    @if ($item->title)
      <header>
        <h2>{{ $item->title }}</h2>
      </header>
    @endif
    <div class="card-code__code {{ $item->ratio && $item->ratio != 'null' ? 'ratio-container ratio-container--' . $item->ratio : '' }}">
      {!! str_replace('allowfullscreen', 'allowfullscreen loading="lazy"', $item->code) !!}
    </div>
  </div>
</article>