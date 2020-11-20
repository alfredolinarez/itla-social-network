@extends('layouts.auth')

@section('title', 'Login')

@section('content')
  <div class="container">
    <div class="row content">
      <div class="col-md-6 mb-3 align-self-center text-center">
        <img src="{{ asset('images/logo.png') }}" class="img-fluid" alt="img">
      </div>
      <div class="col-md-6">
        <h3 class="black-text mb-3 primary-color">¡Bienvenido!</h3>
        <p class="mb-3 text-center">Iniciar sesión en tu cuenta</p>
        <form action="{{ route('login') }}" method="POST">
          @csrf

          @if ($login_failed ?? '')
            El usuario y contraseña no coinciden
          @endif

          <div class="form-group">
            <label for="username" class="black-text">Usuario</label>
            <input type="text" name="username" class="form-control"></input>
          </div>
          <div class="form-group">
            <label for="password" class="black-text">Contraseña</label>
            <input type="password" name="password" class="form-control"></input>
          </div>
          <div class="buttons1">
            <button class="btn btn-class">Login</button>
            <a href="{{ route('register') }}" class="btn btn-class">Register</a>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
