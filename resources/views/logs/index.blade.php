@extends('layouts.home')

@section('content')


<div class = 'flex flex-col'>
  <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
    <div class = 'rounded overflow-hidden shadow bg-white mx-2 w-full'>
      <div class = 'px-6 py-2 border-b border-light-grey'>
        <div class = 'font-bold text-xl'>
          Actividad reciente
        </div>
      </div>
      <div class = 'table-responsive'>
        <table class = 'table text-grey-darkest'>
          <thead class = 'bg-grey-dark text-white text-normal'>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Acción</th>
                <th>Sección</th>
                <th>ID fila afectada</th>
                <th>Descripción</th>
                <th>Fecha</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($activity as $item)
              <tr>
                <td scope="row">{{$item->id}}</td>
                <td>{{$item->usuario->user_data->names}} {{$item->usuario->user_data->last_name}}</td>
                <td>{{$item->act->name}}</td>
                <td>{{$item->section}}</td>
                <td>{{$item->row_affected}}</td>
                <td>{{$item->description}}</td>
                <td>{{$item->date}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


@endsection