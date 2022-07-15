<div {{ $attributes->merge(['class' => 'collapsible js-clpsbl ' . ($expanded ? 'is-expanded' : '') ]) }}>
  <h2>
    <a href="javascript:;" class="btn-collapsible js-clpsbl-btn">
      {{ $title }}
    </a>
  </h2>
  <div class="js-clpsbl-body" style="display: {{ $expanded ? 'block' : 'none' }}">
    {{ $slot }}
  </div>
</div>