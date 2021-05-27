@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

              <div class="card-header">  <h4 class="box-title">Usuario</h4></div>

              <div class="card-body">

<div class="box box-success">
  <div class="box-heder with-border">
    <h4 class="box-title"><center>Id: {{$user->id}}</center></h3>
  </div>
  <div class="box-body">
    <h5>Nombre</h5>
    <ul class="list-group">
      <li class="list-group-item">
        {{$user->name}}
      </li>
    </ul>
    <p>
    <h5>Correo</h5>
    <ul class="list-group">
      <li class="list-group-item">
        {{$user->email}}
      </li>
    </ul>
    <p>
    <h5>Rol</h5>
    <ul class="list-group">
      <li class="list-group-item">
        {{$user->role->name}}
      </li>
    </ul>
</div>

</div>
</div>

</div>
</div>
</div>
</div>
@endsection
