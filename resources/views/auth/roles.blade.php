@extends('web.layout.frontend')
@section('seo_title', 'Benutzerrolle wählen')
@section('content')
<section>
  @if ($roles)
  <h1>Benutzerrolle wählen:</h1>
    @foreach($roles as $role)
      <div>
        <a href="{{ route('page.role.set', ['role' => $role->uuid]) }}">{{ $role->name }}</a>
      </div>
    @endforeach
    <div class="mt-5x">
      <a href="{{ route('logout') }}">Logout</a>
    </div>
  @endif
</section>
@endsection