@extends('layouts.home')

@section('content')

<div class="row">
    <!-- .col -->
    <div class="col-md-12 col-lg-8 col-sm-12">
        <div class="card white-box p-0">
            <div class="card-body">
                <h3 class="box-title mb-0">Tus tickets</h3>

                <div class="table-responsive">
                <table class="table no-wrap">
                    <thead>
                        <tr>
                            <th class="border-top-0">Estatus</th>
                            <th class="border-top-0">Proyecto</th>
                            <th class="border-top-0">Titulo</th>
                            <th class="border-top-0">Descripción</th>
                            <th class="border-top-0">Prioridad</th>
                            <th class="border-top-0">Fecha vencimiento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ticket_info as $ticket)
                            <tr>
                                <td>
                                    @switch($ticket['id_status'])
                                        @case(1)
                                            <span class="badge bg-primary rounded">{{$ticket['status']}}</span>
                                        @break
                                        @case(2)
                                            <span class="badge bg-warning rounded">{{$ticket['status']}}</span>
                                        @break
                                        @case(3)
                                            <span class="badge bg-success rounded">{{$ticket['status']}}</span>
                                        @break
                                        @case(4)
                                            <span class="badge bg-sucess rounded">{{$ticket['status']}}</span>
                                        @break
                                    @endswitch
                                </td>
                                <td class="txt-oflo">{{$ticket['proyecto']}}</td>
                                <td>{{$ticket['titulo']}}</td>
                                <td class="txt-oflo">{{$ticket['descripcion']}}</td>
                                <td>
                                    @switch($ticket['id_priority'])
                                        @case(1)
                                            <span class="text-danger">{{$ticket['prioridad']}}</span>
                                        @break
                                        @case(2)
                                            <span class="text-warning">{{$ticket['prioridad']}}</span>
                                        @break
                                        @case(3)
                                            <span class="text-success">{{$ticket['prioridad']}}</span>
                                        @break
                                    @endswitch
                                </td>
                                <td>{{$ticket['fecha']}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
            <!-- <div class="comment-widgets">
               
                <div class="row">
                    <div class="col-md-1">
                        <h5 class="font-medium">Estatus</h5>
                    </div>
                    <div class="col-md-6">
                        <h5 class="font-medium">Poryecto y Descripción</h5>
                    </div>
                    <div class="col-md-2">
                        <h5 class="font-medium">
                            Prioridad
                        </h5>
                    </div>
                    <div class="col-md-2">
                        <h5 class="font-medium">Fecha entrega</h5>
                    </div>
                </div>
                @foreach($ticket_info as $ticket)
                <div class="row">
                    <div class="col-md-1">
                        <div class="p-2">
                            @switch($ticket['id_status'])
                                @case(1)
                                    <span class="badge bg-primary rounded">{{$ticket['status']}}</span>
                                @break
                                @case(2)
                                    <span class="badge bg-warning rounded">{{$ticket['status']}}</span>
                                @break
                                @case(3)
                                    <span class="badge bg-success rounded">{{$ticket['status']}}</span>
                                @break
                                @case(4)
                                    <span class="badge bg-sucess rounded">{{$ticket['status']}}</span>
                                @break
                            @endswitch
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="font-medium">{{$ticket['proyecto']}}</h5>
                        <span class="mb-3 d-block">{{$ticket['descripcion']}}</span>
                        
                    </div>
                    <div class="col-md-2">
                        <div class="p-2">
                            {{$ticket['prioridad']}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="text-muted fs-2 ms-auto mt-2 mt-md-0">April 14, 2021</div>
                    </div>
                </div>
                @endforeach
            </div> -->
        </div>
    </div>
    
</div>
@endsection