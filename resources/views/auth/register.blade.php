@extends('web.layout.frontend')
@section('html_class', 'is-auth')
@section('seo_title', __('Registrieren'))
@section('page_title', __('Registrieren'))
@section('content')
<section class="container" id="app-register">
  <user-register />
</section>
<script src="{{ mix('assets/js/global/register.js') }}" type="text/javascript"></script>
@endsection
