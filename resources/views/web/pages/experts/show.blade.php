@extends('web.layout.frontend')
@section('seo_title', __('Experte'))
@section('page_title', __('Experte'))
@section('content')
<section class="content">
  <x-article-text-media 
    image="viak-keyvisual-experten.jpg" 
    title="{{ $expert->fullname }}"
    subtitle="Der VFX- und Animationsexperte" 
    text="<p>Helge Maus ist renomierter Trainer im Bereich 3D und dürfte vielen ein Begriff sein.</p><p>Er unterstützt seine Kund/-innen mit professionellen Produktions-Workflows und Techniken. Dabei stehen folgende Tools im Mittelpunkt: Houdini FX, Cinema 4D, Maya, Blender, NUKE, After Effects, V-Ray, RenderMan, Corona, Unreal Engine, Unity, Substance Painter, DaVinci Resolve & Fusion.</p><p>Er hat einige Jahre als Freelancer für Adobe Systems gearbeitet und ist Maxon Certified Lead Instructor. Seine Kunden kommen hauptsächlich aus dem Bereich VFX, Postproduction, MotionGraphics, Broadcast, Automotive & Architektur. Er hat u.a. mit folgenden Firmen gearbeitet: Jura, Vitra, Dyson, Jung-von-Matt, Pirates'n Paradise, redseven Entertainment, ProSiebenSat.1, SKY Deutschland, NDR, rbb, Sony DADC, Intel viele weitere internationale Firmen</p>"
    :reverse="false"
  />
</section>
@if ($courses)
  <section class="content">
    <x-collapsible title="{{ __('Kurse') }}" :expanded="true">
      @foreach($courses as $course)
        <a href="{{ route('page.course', ['slug' => $course->slug, 'course' => $course->uuid]) }}" class="icon-arrow-right:before" title="{{ $course->title }}">
          @include('web.partials.icons.arrow-right')
          <span>{{ $course->title }}</span>
        </a>
      @endforeach
    </x-collapsible>
  </section>
@endif
@endsection