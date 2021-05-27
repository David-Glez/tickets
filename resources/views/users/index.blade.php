@extends('layouts.app')

@section('content')

@if(session()->has('flash'))
<div class="alert alert-success">{{session('flash')}}</div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">Todos los usuarios</div>

                <div class="card-body">

                  <table id="news-table" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Id</th>
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
                          <a href="{{route('see-user', $user)}}" class="btn btn-xs btn-primary">
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
</div>

@endsection
