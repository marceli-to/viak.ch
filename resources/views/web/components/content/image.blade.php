@if ($maxSizes)
  <picture>
    @foreach($maxSizes as $minWidth => $maxSize)
      @if ($minWidth > 0)
        <source media="(min-width: {{ $minWidth }}px)" data-srcset="/img/cache/{{ $image->name }}/{{ $maxSize}}/{{ $image->coords }}/{{ $ratio }}">
      @else
        <img 
          data-src="/img/cache/{{ $image->name }}/{{ $maxSize }}/{{ $image->coords }}/{{ $ratio }}" 
          src="/media/viak-placeholder-teaser.png"
          width="{{ $width }}" 
          height="{{ $height }}"
          title="{{ $image->title }}"
          class="is-responsive lazy"
          alt="{{ $caption ?? '' }}">
      @endif
    @endforeach
  </picture>
@endif
