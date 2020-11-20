@extends('layouts.main')

@section('title', 'Friends')

@section('content.main')
<!-- COLUMNA DE PUBLICACIONES-->
<div class="col-6">
    <h3 class="title1-text primary-color text-left" style="margin-top:20px;">Publicaciones</h3>
    <!--LISTADO DE PUBLICACIONES-->

    @forelse($user->friends_posts as $post)
      <div class="caja-listado">
        <div class="d-flex bd-highlight">
            <div class="w-100 bd-highlight">
                <h5 class="title2-text primary-color" id="user" style="display:inline;">{{ $post->user->fullname }}</h5>
                <p class="title3-text" style="margin-left: 5px; display:inline;">{{ $post->elapsed_time }}</p>
                @if($post->created_at != $post->updated_at)
                  <p class="title3-text text-muted font-italic" style="margin-left: 5px; display:inline;">editado</p>
                @endif
            </div>
        </div>
        <p>{{ $post->content }}</p>
        <hr class="line1">
        <form action="{{ route('post.comment', $post->id) }}" method="POST">
          @csrf

          <input class="form-control textarea-autosize" rows="2" placeholder="Comentar algo..." name="comment" required></textarea>
        </form>
        <hr class="line1">

        <!--Comentario-->
        @foreach($post->comments as $comment)
          <div class="caja-comentario h-auto d-inline-block">
            <h5 class="title3-text primary-color" style="margin-bottom: 0px;" id="comment">{{ $comment->user->fullname }}</h5>
            <p>{{ $comment->comment }}</p>
          </div>
        @endforeach
      </div>
    @empty
      <p class="text-center primary-color">No hay publicaciones de amigos</p>
    @endforelse

    </div>

  <div class="sidebar-perfil col-3">
    <h3 class="title1-text primary-color text-left">Amigos</h3>
    <div class="caja-listado">
      <form action="{{ route('friends') }}" method="POST">
        @csrf

        @if($username_required ?? '')
          <div class="alert alert-danger">Nombre de usuario requerido</div>
        @endif

        @if($user_not_found ?? '')
          <div class="alert alert-danger">Este usuario no existe</div>
        @endif

        <input class="form-control" placeholder="Buscar amigo..." name="username"></input>
        <div class="buttons1">
          <button class="btn btn-class" style="margin-top: 20px;" type="submit">Agregar</button>
        </div>
      </form>
    </div>

    @forelse($user->friends as $friend)
      <div class="caja-listado-amigos">
          <h5 class="title2-text primary-color text-left" id="user">{{ $friend->fullname }}</h5>
          <p class="text-left">{{ $friend->username }}</p>
        </div>
      </div>
    @empty
      <p class="text-center primary-color">No tienes amigos</p>
    @endforelse
  </div>

@endsection