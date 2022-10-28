@extends('web.layout.frontend')
@section('html_class', 'is-auth')
@section('page_title', __('Zahlung erhalten'))
@section('content')
<section class="container">
  <x-article-text>
    <x-slot name="aside">
      <h1 class="xs:hide">{{ __('Zahlung erhalten') }}</h1>
    </x-slot>
    <x-slot name="content">
      <p>{{ __('Wir haben deine Zahlung für die Rechnung Nr. ' . $invoice->number .' erhalten. Vielen Dank.') }}</p>
    </x-slot>
  </x-article-text>
</section>
@endsection