<figure class="{{ $wrapperClass ?? '' }}">
  @if ($maxSizes)
    <picture>
      @foreach($maxSizes as $minWidth => $maxSize)
        @if ($minWidth > 0)
          <source media="(min-width: {{ $minWidth }}px)" data-srcset="/img/cache/{{ $image->name }}/{{ $maxSize}}/{{ $image->coords }}/{{ $ratio }}">
        @else
          <img 
            data-src="/img/cache/{{ $image->name }}/{{ $maxSize }}/{{ $image->coords }}/{{ $ratio }}" 
            width="{{ $width }}" 
            height="{{ $height }}"
            title="{{ $image->title }}"
            class="is-responsive lazy">
        @endif
      @endforeach
    </picture>
  @endif
</figure>
