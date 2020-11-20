@extends('layouts.main')

@section('title', 'Home')

@section('content.main')
  <!-- COLUMNA DE PUBLICACIONES-->
  <div class="col-6">
    <!--AGREGAR PUBLICACIONES-->
    <form action="{{ $editting ? route('post.edit', $editting->id) : route('home') }}" method="POST">
      @csrf

      <div class="caja-agregar">
        <h3 class="title1-text primary-color">{{ $editting ? 'Editar' : 'Crear' }} publicación</h3>

        @if($content_required ?? '')
          <div class="alert alert-danger">No se pueden crear publicaciones en blanco</div>
        @endif

        <textarea class="form-control textarea-autosize" rows="3" placeholder="Escribe algo..." name="content">{{ $editting->content ?? '' }}</textarea>
        <div class="d-flex justify-content-center">
          <button class="btn btn-class" type="submit">
            {{ $editting ? 'Actualizar' : 'Publicar' }}
          </button>

          @if($editting)
            <a class="btn btn-class mx-2" href="{{ route('post.edit.cancel', $editting->id) }}">Cancelar</a>
          @endif

        </div>
      </div>
    </form>

    <!--LISTADO DE PUBLICACIONES-->
    @forelse($user->posts as $post)
      <div class="caja-listado">
        <div class="d-flex bd-highlight">
            <div class="w-100 bd-highlight" >
                <h5 class="title2-text primary-color" id="user" style="display:inline;">{{ $user->fullname }}</h5>
                <p class="title3-text" style="margin-left: 5px; display:inline;">{{ $post->elapsed_time }}</p>
                @if($post->created_at != $post->updated_at)
                  <p class="title3-text text-muted font-italic" style="margin-left: 5px; display:inline;">editado</p>
                @endif
            </div>
            <div class="p-2 bd-highlight">
                <div class="btn-group" style="margin-right:-40px; margin-top:-55px">
                    <button class="btn btn-danger btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('post.edit', $post->id) }}">Editar</a>
                        <a class="dropdown-item" href="{{ route('post.delete', $post->id) }}">Eliminar</a>
                    </div>
                </div>
            </div>
        </div>
        <p>{{ $post->content }}</p>
        <hr class="line1">
        <form action="{{ route('post.comment', $post->id) }}" method="POST">
          @csrf

          <input class="form-control textarea-autosize" name="comment" placeholder="Comentar algo..." required />
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
      <p class="text-center primary-color">No tienes publicaciones</p>
    @endforelse

  </div>

  <div class="sidebar-perfil col-3">
    <h3 class="title1-text primary-color">¡Bienvenido!</h3>
    <h5 class="title1-text text-center">{{ $user->fullname }}</h5>
    <p class="text-center">{{ $user->at_username }}</p>
  </div>
@endsection
<script>
  window.onload=function(){
  var pos=window.name || 0;
  window.scrollTo(0,pos);
  }
  window.onunload=function(){
  window.name=self.pageYOffset || (document.documentElement.scrollTop+document.body.scrollTop);
}
</script>