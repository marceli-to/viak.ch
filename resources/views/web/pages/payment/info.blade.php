@extends('web.layout.frontend')
@section('html_class', 'is-auth')
@section('seo_title', __('Rechnung bereits bezahlt'))
@section('page_title', __('Rechnung bereits bezahlt'))
@section('content')
<section class="container">
  <x-article-text>
    <x-slot name="aside">
      <h1 class="xs:hide">{{ __('Rechnung bezahlt') }}</h1>
    </x-slot>
    <x-slot name="content">
      <p>{!! __('Die Rechnung <strong>' . $invoice->number .'</strong> wurde am '. $invoice->paid_at_str .' beglichen.') !!}</p>
    </x-slot>
  </x-article-text>
</section>
@endsection