@extends('admin.master')
@section('title','Categorías')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/services') }}" class="nav-link"><i class="fas fa-laptop-house"></i> Servicios</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-5">
                <div class="panel shadow">

                    <div class="header">
                        <h2 class="title"><i class="fas fa-edit"></i> Editar Servicio</h2>
                    </div>

                    <div class="inside">
                        {!! Form::open(['url' => '/admin/service/'.$service->id.'/edit']) !!}
                        <label for="name">Nombre:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('name', $service->name, ['class'=>'form-control']) !!}
                                </div>

                                <label for="unit_id"  class="mtop16">Unidad a la que pertence:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    {!! Form::select('unit_id', $units,$service->unit_id,['class'=>'form-select']) !!}
                                </div>

                            {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}

                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>

        
    </div>

@endsection