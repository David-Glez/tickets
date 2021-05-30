@extends('layouts.home')

@section('content')

@if(session()->has('flash'))
<div class="alert alert-success">{{session('flash')}}</div>
@endif

<div class = 'flex flex-col'>
  <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
    <div class = 'rounded overflow-hidden shadow bg-white mx-2 w-full'>
      <div class = 'px-6 py-2 border-b border-light-grey'>
        <div class = 'font-bold text-xl'>
          Tickets
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
                <td scope="row">{{$ticket->id}}</td>
                <td>{{$ticket->titulo}}</td>
                <td>{{$ticket->status->name}}</td>
                <td>{{$ticket->priority->name}}</td>
                <td>
                  <a href="{{route('show-ticket', $ticket)}}" class="btn btn-xs btn-info">
                    <img src="/icons/v.png" width="10" height="10"> Ver
                  </a>
                  @if( $ticket->status_id < 3)
                  <a href="{{route('take-ticket', $ticket)}}" class="btn btn-xs btn-primary">
                    <img src="/icons/t.png" width="10" height="10"> Tomar
                  </a>
                  @endif
                  
                  @if( $ticket->status_id < 3)
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
