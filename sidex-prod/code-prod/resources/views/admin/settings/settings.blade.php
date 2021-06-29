@extends('admin.master')
@section('title','Configuraciones')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/settings') }}" class="nav-link"><i class="fas fa-cogs"></i> Configuraciones</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-cogs"></i> Configuraciones</h2>
            </div>

            <div class="inside">
                {!! Form::open(['url' => '/admin/settings']) !!}
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name">Nombre del Sistema:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('name', Config::get('sidex.name'), ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="default_password">Contraseña Por Defecto (Usuario Nuevo):</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('default_password', Config::get('sidex.default_password'), ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="company_phone">Teléfono:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::number('company_phone', Config::get('sidex.company_phone'), ['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    

                    <div class="row mtop16">
                        <div class="col-md-4">
                            <label for="map">Ubicaciones:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('map', Config::get('sidex.map'), ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="products_per_page">Unidades Por Pagina:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('products_per_page', Config::get('sidex.products_per_page'), ['class'=>'form-control']) !!}
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