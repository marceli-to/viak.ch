<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if(trim($__env->yieldContent('html_class'))) class="@yield('html_class')"@endif>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@if(trim($__env->yieldContent('seo_title')))@yield('seo_title') • {{config('seo.title')}}@else{{config('seo.title')}}@endif</title>
<meta name="description" content="@if(trim($__env->yieldContent('seo_description')))@yield('seo_description')@else{{config('seo.description')}}@endif">
<meta name="keywords" content="@if(trim($__env->yieldContent('seo_keywords')))@yield('seo_keywords')@else{{config('seo.keywords')}}@endif">
<meta property="og:title" content="@if(trim($__env->yieldContent('seo_title')))@yield('seo_title') &bull; {{config('seo.title')}}@else{{config('seo.title')}}@endif">
<meta property="og:description" content="@if(trim($__env->yieldContent('seo_description')))@yield('seo_description')@else{{config('seo.description')}}@endif">
<meta property="og:url" content="{{url()->current()}}">
@if (request()->routeIs('*.page.experts'))
<meta property="og:image" content="{{ asset('assets/img/viak-og-experts.jpg') }}">
@else
<meta property="og:image" content="@if(trim($__env->yieldContent('og_image')))@yield('og_image')@else{{ asset('assets/img/viak-og.jpg') }}@endif">
@endif
<meta property="og:site_name" content="{{config('seo.title')}}">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="format-detection" content="telephone=no">
<link href="https://use.typekit.net/kcs4ept.css" rel="stylesheet">
<link href="{{ mix('assets/css/app.css') }}" rel="stylesheet">
<script src="/assets/js/modernizr.js"></script>
</head>
<body>