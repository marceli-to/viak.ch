@extends('web.layout.frontend')
@section('html_class', 'is-auth')
@section('seo_title', __('Registrieren'))
@section('content')
<section class="content" id="app-register">
  <register-form />
</section>
<script src="{{ mix('assets/js/register.js') }}" type="text/javascript"></script>
@endsection
