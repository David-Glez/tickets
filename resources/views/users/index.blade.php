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
              <th>Departamento</th>
              <th>Proyecto</th>
              <th>Rol</th>
              <th>Estatus</th>
              <th>E-mail</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
            <tr>
              <td>{{$user['id']}}</td>
              <td>{{$user['nombre']}}</td>
              <td>{{$user['departamento']}}</td>
              <td>{{$user['proyecto']}}</td>
              <td>{{$user['roles']}}</td>
              <td>
                @if($user['status'] == true)
                <span class="badge bg-success rounded">Activo</span>
                @else
                <span class="badge bg-danger rounded">Inactivo</span>
                @endif
              </td>
              <td>{{$user['email']}}</td>
              <td>
                
                @can('user.show')
                <a href = "{{route('see-user', $user['id'])}}" class = 'btn btn-xs btn-primary' >
                  <img src="/icons/v.png" width="10" height="10"> Ver
                </a>
                @endcan
                @can('user.edit')
                <a href="{{route('user-modify', $user['id'])}}" class="btn btn-xs btn-info">
                  <img src="/icons/e.png" width="10" height="10"> Editar
                </a>
                @endcan
                @can('user.destroy')
                  
                  <form method="post" action="{{route('user-delete', $user['id'])}}" style="display: inline">
                    @csrf
                    {{method_field('DELETE')}}
                      <button class="btn btn-xs btn-danger" onclick="return confirm('??Est?? seguro de querer eliminar?')">
                        <img src="/icons/x.png" width="10" height="10"> Eliminar
                      </button>
                  </form>
                  
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

