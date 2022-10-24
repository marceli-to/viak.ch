<article {{ $attributes ? $attributes : 'class="card-text"' }}>
  <div>
    <aside>
      {{ $aside ?? '' }}
    </aside>
    <div>
      {{ $content ?? '' }}
    </div>
  </div>
</article>