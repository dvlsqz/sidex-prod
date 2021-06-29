@extends('admin.master')
@section('title','Editar Producto')

@section('breadcrumb')
    <li class="breadcrumb-item">
    <a href="{{ url('/admin/telephone_extensions/1') }}" class="nav-link"><i class="fas fa-phone-square-alt"></i> Extensiones Telefonicas</a>
    </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-edit"></i> Editar Extensión Telefonica</h2>
                </div>

                <div class="inside">
                    {!! Form::open(['url'=>'/admin/telephone_extension/'.$te->id.'/edit']) !!}
                        <div class="row">

                            <div class="col-md-4">
                                <label for="number">Numero de la Extensión:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('number', $te->number, ['class'=>'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="direct_number">Numero Directo de la Extensión:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('direct_number', $te->direct_number, ['class'=>'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="ip">IP de la Extensión:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('ip', $te->ip, ['class'=>'form-control']) !!}
                                </div>
                            </div>

                        </div>

                        <div class="row mtop16">

                            <div class="col-md-3">
                                <label for="accountable">Responsable de Responder:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('accountable', $te->accountable, ['class'=>'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="description">Descripcion de Ubicación:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('description', $te->description, ['class'=>'form-control']) !!}
                                </div>
                            </div>

                            @if(kvfj(Auth::user()->permissions, 'telephone_extension_location_edit'))
                                <div class="col-md-3">
                                    <label for="service_id">Servicio:</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                        {!! Form::select('service_id', $serv, $te->service_id,['class'=>'form-select']) !!}
                                    </div>
                                </div>
                            @endif

                            @if(kvfj(Auth::user()->permissions, 'telephone_extension_status_edit'))
                                <div class="col-md-3">
                                    <label for="status">Estado:</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-file"></i></span>
                                        {!! Form::select('status', ['0'=>'No Pública','1'=>'Publica'],$te->status,['class'=>'form-select']) !!}
                                    </div>  
                                </div>
                            @endif

                        </div>

                        <div class="row mtop16">
                            <div class="col-md-12">
                                {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
                            </div>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
</div>

@endsection