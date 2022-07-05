@extends('web.layout.guest')
@section('content')
<section>
  <div class="grid-cols-12">
    @if ($courses)
      <div class="span-8">
        <div class="grid-cols-12">
          @foreach($courses as $course)
            <div class="span-6 p-4x"style="border: 1px solid green">
              <a href="{{ route('page.course', ['course' => $course->slug]) }}" class="mb-12x">
                <div>
                  <div>
                    @if ($course->categories)
                      @foreach($course->categories as $category)
                        {{$loop->last ? $category->description : $category->description . ', '}}
                      @endforeach
                    @endif
                  </div>
                  <h1>{{ $course->title }}</h1>
                </div>
                <figure>
                  <img src="/media/dummy-{{rand(1,5)}}.png" class="is-responsive">
                </figure>
              </a>
            </div>
          @endforeach
        </div>
      </div>
      <div class="span-4">
        <h2>Filter</h2>
      </div>  
    @endif
  </div>
</section>
@endsection