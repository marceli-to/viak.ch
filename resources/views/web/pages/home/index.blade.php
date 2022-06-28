@extends('web.layout.guest')
@section('content')
<section>
  @auth
    @if (session('user-selected-role'))
      <div style="position: fixed; top: 10px; right: 10px; color: green">Angemeldet als: {{ session('user-selected-role')->name }}</div>
    @endif
  @endauth

  <h1>Home</h1>
  @if (auth()->user())
    <a href="{{ route('logout') }}">Logout</a>
  @else
    <a href="{{ route('login') }}">Login</a>
  @endif
</section>
@endsection