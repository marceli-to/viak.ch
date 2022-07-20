@extends('web.layout.frontend')
@section('html_class', 'is-auth')
@section('seo_title', __('Profil'))
@section('page_title', __('Profil'))
@section('content')
<section class="content" id="app-profile">
  <expert-profile />
</section>
<script src="{{ mix('assets/js/expert/profile.js') }}" type="text/javascript"></script>
@endsection
