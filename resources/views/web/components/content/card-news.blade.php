<article class="card-news sm:grid-cols-12">

  <div class="sm:span-6">
    <header>
      <h2>{{ $news->title }}</h2>
    </header>
    <div class="card-news__text">
      @if ($news->link)
        <a href="{{ $news->link }}" title="{{ __('Mehr...') }}" target="{{ $target }}">
          {!! $news->text !!}
          @include('web.partials.icons.arrow-right')
        </a>
      @else
        {!! $news->text !!}
      @endif
    </div>
  </div>
  <figure class="sm:span-6">
    @if ($news->publishedImage)
      @if ($news->link)
        <a href="{{ $news->link }}" title="{{ __('Mehr...') }}" target="{{ $target }}">
          <x-image :maxSizes="[0 => 700, 700 => 1100]" width="600" height="600" :image="$news->publishedImage" ratio="16x9" :caption="$news->title" />
        </a>
      @else
        <x-image :maxSizes="[0 => 700, 700 => 1100]" width="600" height="600" :image="$news->publishedImage" ratio="16x9" :caption="$news->title" />
      @endif
    @else
      <img src="/media/viak-placeholder-teaser.png" height="600" width="600" class="is-responsive" alt="{{ $news->title }}">
    @endif
  </figure>
</article>