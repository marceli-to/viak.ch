@extends('web.layout.frontend')
@section('html_class', 'is-auth')
@section('seo_title', __('Kurs'))
@section('page_title', __('Kurs'))
@section('content')
<section class="container" id="app-student">
  <app-component />
</section>
<script src="{{ mix('assets/js/student/app.js') }}" type="text/javascript"></script>
@endsection
