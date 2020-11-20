@extends('layouts.base')

@section('content')
  <x-header />

  <div class="container-fluid">
    <div class="row">
      <x-sidebar />

      @yield('content.main')
    </div>
  </div>
@endsection