@extends('web.layout.frontend')
@section('html_class', 'is-auth')
@section('seo_title', __('Profil'))
@section('page_title', __('Profil'))
@section('content')

<section class="container" id="app-student">
  <app-component />
</section>
<script src="{{ mix('assets/js/student/app.js') }}" type="text/javascript"></script>

{{-- <section class="container" id="app-profile">
  <student-profile />
</section> 
<script src="{{ mix('assets/js/student/profile.js') }}" type="text/javascript"></script>
--}}
@endsection
