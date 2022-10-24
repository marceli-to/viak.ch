<article class="card-news grid-cols-12">
  <div class="span-6">
    <header>
      <h2>{{ $news->title }}</h2>
    </header>
    <div class="card-news__text">
      {!! $news->text !!}
    </div>
  </div>
  <figure class="span-6">
    @if ($news->publishedImage)
      <x-image :maxSizes="[0 => 700, 700 => 1100]" width="600" height="600" :image="$news->publishedImage" ratio="16x9" :caption="$news->title" />
    @else
      <img src="/media/viak-placeholder-teaser.png" height="600" width="600" class="is-responsive" alt="{{ $news->title }}">
    @endif
  </figure>
</article>