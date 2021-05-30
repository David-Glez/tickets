@extends('layouts.home')

@section('content')

<div class = 'flex flex-col'>


<div class = 'flex flex-col'>
  <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
    <div class = 'rounded overflow-hidden shadow bg-white mx-2 w-full'>
      <div class = 'px-6 py-2 border-b border-light-grey'>
        <div class = 'font-bold text-xl'>
          Tickets Solicitados
        </div>
      </div>
      <div class = 'table-responsive'>
        <table class = 'table text-grey-darkest'>
          <thead class = 'bg-grey-dark text-white text-normal'>
            <tr>
                <th>Folio</th>
                <th>Titulo</th>
                <th>Estatus</th>
                <th>Prioridad</th>
                <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($tickets as $ticket)
            <tr>
              <td>{{$ticket->id}}</td>
              <td>{{$ticket->titulo}}</td>
              <td>{{$ticket->status->name}}</td>
              <td>{{$ticket->priority->name}}</td>
              <td>
                <a href="{{route('show-ticket', $ticket)}}" class="btn btn-xs btn-info">
                  <img src="/icons/v.png" width="10" height="10"> Ver </img>
                </a>
                @if($ticket->status_id < 3 && $ticket->user->id == auth()->id())
                
                <form method="POST" action="{{route('ticket-delet', $ticket)}}" style="display: inline">
                  {{csrf_field()}} {{method_field('DELETE')}}
                  <button class="btn btn-xs btn-danger" onclick="return confirm('¿Está seguro de querer eliminar?')">
                    <img src="/icons/x.png" width="10" height="10"> Rechazar
                  </button>
                </form>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection

