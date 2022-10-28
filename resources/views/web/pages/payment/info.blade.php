@extends('web.layout.frontend')
@section('html_class', 'is-auth')
@section('page_title', __('Rechnung bezahlt'))
@section('content')
<section class="container">
  <x-article-text>
    <x-slot name="aside">
      <h1 class="xs:hide">{{ __('Rechnung bezahlt') }}</h1>
    </x-slot>
    <x-slot name="content">
      <p>{{ __('Die Rechnung Nr. ' . $invoice->number .' wurde am '. $invoice->paid_at_str .' beglichen.') }}</p>
    </x-slot>
  </x-article-text>
</section>
@endsection