<div class="sidebar-menu col-3 ">
  <div class="row"></div>
  <a href="{{ route('home') }}">
    <div class="row">
        <img src="{{ asset('images/icono.png') }}"  class="img-fluid icono-menu" alt="img">
        <h5 class="title2-text">Home</h5>
    </div>
  </a>
  <a href="{{ route('friends') }}">
    <div class="row">
        <img src="{{ asset('images/friends1.png') }}"  class="img-fluid icono-menu" alt="img">
        <h5 class="title2-text">Amigos</h5>
    </div>
  </a>
  <a href="{{ route('logout') }}">
    <div class="row">
        <img src="{{ asset('images/logout1.png') }}"  class="img-fluid icono-menu" alt="img">
        <h5 class="title2-text">Cerrar Sesión</h5>
    </div>
  </a>
</div>