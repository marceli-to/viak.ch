@extends('web.layout.frontend')
@section('page_title', __('Mein Warenkorb'))
@section('content')
<section class="content" id="app-checkout">
  <article class="text">
    <aside>
      <h1 class="xs:hide">{{ __('Mein Warenkorb') }}</h1>
    </aside>
  </article>
  <order-checkout />
</section>
@endsection
