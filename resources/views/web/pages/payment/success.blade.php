@extends('web.layout.frontend')
@section('html_class', 'is-auth')
@section('seo_title', __('Kreditkartenzahlung erfolgreich'))
@section('page_title', __('Kreditkartenzahlung erfolgreich'))
@section('content')
<section class="container">
  <x-article-text>
    <x-slot name="aside">
      <h1 class="xs:hide">{{ __('Kreditkartenzahlung erfolgreich') }}</h1>
    </x-slot>
    <x-slot name="content">
      <p>{{ __('Wir haben deine Zahlung für die Rechnung Nr. :invoice_number erhalten. Vielen Dank.', ['invoice_number' => $invoice->number]) }}
    </x-slot>
  </x-article-text>
</section>
@endsection