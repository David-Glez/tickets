@extends('layouts.home')

@section('content')


<div class = 'flex flex-col'>
  <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
    <div class = 'rounded overflow-hidden shadow bg-white mx-2 w-full'>
      <div class = 'px-6 py-2 border-b border-light-grey'>
        <div class = 'font-bold text-xl'>
          Usuarios
        </div>
      </div>
      <div class = 'table-responsive'>
        <table class = 'table text-grey-darkest'>
          <thead class = 'bg-grey-dark text-white text-normal'>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Rol</th>
              <th>E-mail</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
            <tr>
              <td>{{$user->id}}</td>
              <td>{{$user->name}}</td>
              <td>{{$user->role->name}}</td>
              <td>{{$user->email}}</td>
              <td>
                <!--<a href="{{route('see-user', $user)}}" class="btn btn-xs btn-primary">-->
                  <a href = '#' class = 'btn btn-xs btn-primary' onclick="return alert('En construccion')">
                  <img src="/icons/v.png" width="10" height="10"> Ver
                </a>
                <a href="" class="btn btn-xs btn-info">
                  <img src="/icons/e.png" width="10" height="10"> Editar
                </a>
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

