@extends('web.layout.frontend')
@section('html_class', 'is-auth')
@section('page_title', __('Mein Warenkorb'))
@section('content')
<section class="container">
  <article class="content-text">
    <aside>
      <h1 class="xs:hide">{{ __('Mein Warenkorb') }}</h1>
    </aside>
  </article>
  <div class="checkout" id="app-checkout">
    <checkout-component />
  </div>
</section>
<script src="{{ mix('assets/js/global/app.js') }}" type="text/javascript"></script>
@endsection
