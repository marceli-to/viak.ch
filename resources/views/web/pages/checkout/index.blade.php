@extends('web.layout.frontend')
@section('page_title', __('Mein Warenkorb'))
@section('content')
<section class="content">
  <article class="text">
    <aside>
      <h1 class="xs:hide">{{ __('Mein Warenkorb') }}</h1>
    </aside>
  </article>
  <div id="app-checkout">
    <checkout-component />
  </div>
</section>
<script src="{{ mix('assets/js/global/checkout.js') }}" type="text/javascript"></script>
@endsection
