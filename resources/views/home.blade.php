@extends('layouts.app')

@section('content')
<div class="container">
  @if(session()->has('flash'))
  <div class="alert alert-success">{{session('flash')}}</div>
  @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                </div>

            </div>
        </div>
    </div>
</div>

<!--////////////////////Modal Productos//////////////////
<div class="fade modal" id="sampleModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Crear producto</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <form method="POST" action="{{route('ticket-create')}}">
				{{csrf_field()}}

          <!-- Text input-
					<div class="form-group  {{$errors->has('name') ? 'has-error' : ''}}">
							<label>Nombre</label>
							<input class="form-control" name="name" placeholder="Nombre del producto">
							{!!$errors->first('name','<span class="help-block">:message</span>')!!}
					</div>
          <!-- Text input-
					<div class="form-group  {{$errors->has('category') ? 'has-error' : ''}}">
							<label>Categoria</label>
							<input class="form-control" name="category" placeholder="Categoria">
							{!!$errors->first('category','<span class="help-block">:message</span>')!!}
					</div>
          <!-- Text input--
					<div class="form-group  {{$errors->has('desc') ? 'has-error' : ''}}">
							<label>Desc</label>
							<input class="form-control" name="desc" placeholder="Desc">
							{!!$errors->first('desc','<span class="help-block">:message</span>')!!}
					</div>

          <div class="modal-footer">
              <div class="pull-right">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
          </div>
      </form>
      </div>
    </div>
  </div>
</div>-->
@endsection
