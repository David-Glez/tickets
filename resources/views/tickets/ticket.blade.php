@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

              <div class="card-header">  <h4 class="box-title">Ticket  </h4></div>

              <div class="card-body">

<div class="box box-success">
  <div class="box-heder with-border">
    <h4 class="box-title"><center>Folio: {{$ticket->id}}</center></h3>
  </div>
  <div class="box-body">
    <h5>Titulo</h5>
    <ul class="list-group">
      <li class="list-group-item">
        {{$ticket->titulo}}
      </li>
    </ul>
    <p>
    <h5>Usuario</h5>
    <ul class="list-group">
      <li class="list-group-item">
        {{$ticket->user->name}}
      </li>
    </ul>
    <p>
    @if( $ticket->status_id > 1)
    <h5>Atendido por:</h5>
    <ul class="list-group">
      <li class="list-group-item">
        @foreach ($user_tickets as $user_ticket)

          {{$user_ticket->user->name}}; <p>

        @endforeach
      </li>
    </ul>
    <p>
    @endif
    <h5>Estatus</h5>
    <ul class="list-group">
      <li class="list-group-item">
        {{$ticket->status->name}}
      </li>
    </ul>
    <p>
    <h5>Prioridad</h5>
    <ul class="list-group">
      <li class="list-group-item">
        {{$ticket->priority->name}}
      </li>
    </ul>
    <p>
    <h5>Categoria</h5>
    <ul class="list-group">
      <li class="list-group-item">
        {{$ticket->category->name}}
      </li>
    </ul>
    <p>
    <h5>Descripción</h5>
    <ul class="list-group">
      <li class="list-group-item"><p>{!!$ticket->description!!}</p></li>
    </ul>
    <form method = 'POST' action = "{{route('upload-file')}}" enctype="multipart/form-data">
      @csrf
      <h5>Añadir archivo </h5>
      <!--  aqui va el id del ticket  -->
      <input type = 'hidden' name = 'id_ticket' id = 'id_ticket' value = "{{$ticket->id}}" />
      <!--  aqui va el id del usuario -->
      <input type = 'hidden' name = 'id_usuario' id = 'id_usuario' value = "{{$ticket->user->id}}" />
      <input type = 'file' name = 'archivo_cargar' id = 'archivo_cargar' class = 'input' />

      <button type = 'submit' name = 'enviar' id = 'enviar'>Enviar archivo </button>
    </form>
</div>

</div>
</div>

</div>
</div>
</div>
</div>
@endsection
