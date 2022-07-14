@extends('web.layout.frontend')
@section('content')
<section id="app-courses">
  <course-filter>
    @if ($experts)
      <div class="grid-cols-12">
        @foreach($experts as $user)
          <x-expert-card :user="$user" />
        @endforeach
      </div>
    @endif
  </course-filter>
</section>
@endsection