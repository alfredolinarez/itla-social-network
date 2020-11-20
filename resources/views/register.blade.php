@extends('layouts.auth')

@section('title', 'Register')

@section('content')
  <div class="container">
    <div class="row content">
      <div class="col-md-12">
        <div class="text-center">
          <img src="{{ asset('images/logo.png') }}" class="img-fluid" alt="img">
        </div>
        <h3 class="black-text mb-3 primary-color">¡Registrarse!</h3>
        <p class="mb-3">Registra una cuenta para iniciar sesión</p>
        <form class="needs-validation" novalidate action="{{ route('register') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="firstname" class="black-text">Nombres</label>
            <input type="text" name="firstname" class="form-control" required></input>
            <div class="valid-feedback">¡Excelente!</div>
            <div class="invalid-feedback">Complete el campo</div>
          </div>
          <div class="form-group">
            <label for="lastname" class="black-text">Apellidos</label>
            <input type="text" name="lastname" class="form-control" required></input>
            <div class="valid-feedback">¡Excelente!</div>
            <div class="invalid-feedback">Complete el campo</div>
          </div>
          <div class="form-group">
            <label for="phone" class="black-text">Teléfono</label>
            <input type="tel" pattern="\d{3}-\d{3}-\d{4}" name="phone" class="form-control" required></input>
            <div class="valid-feedback">¡Excelente!</div>
            <div class="invalid-feedback">Formato invalido, el formato correcto es 000-000-0000</div>
          </div>
          <div class="form-group">
            <label for="email" class="black-text">Correo Electrónico</label>
            <input type="email" name="email" class="form-control" required></input>
            <div class="valid-feedback">¡Excelente!</div>
            <div class="invalid-feedback">Complete el campo</div>
          </div>
          <div class="form-group">
            <label for="username" class="black-text">Nombre de usuario</label>
            <input type="text" name="username" class="form-control" required></input>
            <div class="valid-feedback">¡Excelente!</div>
            <div class="invalid-feedback">Complete el campo</div>
          </div>
          <div class="form-group">
            <label for="password" class="black-text">Contraseña</label>
            <input type="password" name="password" class="form-control" required></input>
            <div class="valid-feedback">¡Excelente!</div>
            <div class="invalid-feedback">Complete el campo</div>
          </div>
          <div class="form-group">
            <label for="verify_password" class="black-text">Confirmar contraseña</label>
            <input type="password" name="verify_password" class="form-control" required></input>
            <div class="valid-feedback">¡Excelente!</div>
            <div class="invalid-feedback">Complete el campo</div>
          </div>
          <div class="buttons1">
            <button class="btn btn-class" type="submit">Aceptar</button>
            <a href="{{ route('login') }}" class="btn btn-class">Cancelar</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>
@endsection