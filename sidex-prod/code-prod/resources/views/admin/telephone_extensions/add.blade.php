@extends('admin.master')
@section('title','Agregar Producto')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/telephone_extensions/1') }}" class="nav-link"><i class="fas fa-phone-square-alt"></i> Extensiones Telefonicas</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/telephone_extension/add') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Agregar Extension Telefonica</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">

            <div class="header">
                <h2 class="title"><i class="fas fa-plus-circle"></i> Agregar Extension Telefonica</h2>

            </div>

            <div class="inside">
                {!! Form::open(['url'=>'/admin/telephone_extension/add']) !!}
                    <div class="row">

                        <div class="col-md-4">
                            <label for="number">Numero de la Extensión:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('number', null, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="direct_number">Numero Directo de la Extensión:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('direct_number', null, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="ip">IP de la Extensión:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('ip', null, ['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row mtop16">

                        <div class="col-md-3">
                            <label for="accountable">Responsable de Responder:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('accountable', null, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="description">Descripcion de Ubicación:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('description', null, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="service_id">Servicio:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                {!! Form::select('service_id', $serv,0,['class'=>'form-select']) !!}
                            </div>
                        </div>
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

@endsection