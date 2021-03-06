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
                <th>Solicitante</th>
                <th>Departamento</th>
                <th>Proyecto</th>
                <th>Estatus</th>
                <th>Prioridad</th>
                <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($data_list as $ticket)
            <tr>
                <td scope="row">{{$ticket['id']}}</td>
                <td>{{$ticket['titulo']}}</td>
                <td>{{$ticket['solicitante']}}</td>
                <td>{{$ticket['departamento']}}</td>
                <td>{{$ticket['proyecto']}}</td>
                <td>{{$ticket['status']}}</td>
                <td>{{$ticket['prioridad']}}</td>
              <td>
                <a href="{{route('ticket-details', $ticket['id'])}}" class="btn btn-xs btn-info">
                  <img src="/icons/v.png" width="10" height="10"> Ver </img>
                </a>
                @can('ticket.destroy')
                @if($ticket['status_id']  < 3 )
                
                <form method="POST" action="{{route('reject-ticket', $ticket['id'])}}" style="display: inline">
                  {{csrf_field()}} {{method_field('DELETE')}}
                  <button class="btn btn-xs btn-danger" onclick="return confirm('¿Está seguro de querer rechazar?')">
                    <img src="/icons/x.png" width="10" height="10"> Rechazar
                  </button>
                </form>
                @endif
                @endcan
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

