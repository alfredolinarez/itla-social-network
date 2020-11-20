@extends('layouts.main')

@section('title', 'Login')

@section('content')
  <div class="container">
    <div class="row content">
      <div class="col-md-6 mb-3 align-self-center text-center">
        <img src="{{ asset('images/logo.png') }}" class="img-fluid" alt="img">
      </div>
      <div class="col-md-6">
        <h3 class="title1-text mb-3 primary-color text-center">¡Bienvenido!</h3>
        <p class="mb-3 text-center title2-text">Iniciar sesión en tu cuenta</p>
        <form action="{{ route('login') }}" method="POST">
          @csrf

          @if($login_failed ?? '')
            <div class="alert alert-danger">El usuario y contraseña no coinciden</div>
          @endif

          @if($not_authenticated ?? '')
            <div class="alert alert-danger">Necesitas iniciar sesión para poder acceder a esta ruta</div>
          @endif

          <div class="form-group">
            <label for="username" class="title2-text">Usuario</label>
            <input type="text" name="username" class="form-control"></input>
          </div>
          <div class="form-group">
            <label for="password" class="title2-text">Contraseña</label>
            <input type="password" name="password" class="form-control"></input>
          </div>
          <div class="buttons1">
            <button class="btn btn-class">Login</button>
            <a class="btn btn-class primary-color" role="button" href="{{ route('register') }}">Register</a>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
