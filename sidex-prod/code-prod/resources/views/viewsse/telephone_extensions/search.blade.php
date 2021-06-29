@extends('master')
@section('title','Extensiones Telefonicas')

@section('content')
<div class="col-md-12 mtop32">
        <div class="panel shadow">

            <div class="header">
                <h2 class="title"><i class="fas fa-phone-square-alt"></i> Extensiones Telefonicas del Servicio</h2>
                <ul>
                    <li>
                        <a href="javascript:history.back()" ><i class="fas fa-arrow-circle-left"></i> Regresar</a>
                    </li>
                    <li>
                        <a href="#" id="btn_search" ><i class="fas fa-search"></i> Buscar</a>
                    </li>
                </ul>
            </div>

            <div class="inside">
                <div class="form_search" id="form_search">
                    {!! Form::open(['url'=> 'services/'.$idService.'/telephone_extension/search']) !!}
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name">Ingrese dato a buscar:</label>
                            {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su busqueda', 'required']) !!}
                        </div>
                        <div class="col-md-4">
                            <label for="name">Seleccione un criterio de busqueda:</label>
                            {!! Form::select('filter',['0'=>'Numero de Extension', '1'=>'Descripcion de Extension'], 0, ['class' => 'form-select']) !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::submit('Buscar', ['class'=>'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>

                <table class="table table-striped table-hover mtop16">
                    <thead>
                        <tr>
                            <td width="480px">NUMERO DE EXTENSIÓN</td>
                            <td width="480px">UBICACIÓN DE EXTENSIÓN</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($telephone_extensions as $te)
                            <tr>
                                <td>{{ $te->number}}</td>
                                <td>{{ $te->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection