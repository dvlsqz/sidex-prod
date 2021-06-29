@extends('master')
@section('title','Servicios')

@section('content')
<section>
    <div class="home_action_bar shadow">
        <div class="row">
            <div class="col-md-5">
                <div class="btn-group" role="group" aria-label="...">
                    <a href="{{url('unit/'.$idService.'/services/todos')}}" type="button" class="btn btn-default">Todos</a>
                    <a href="{{url('unit/'.$idService.'/services/a')}}" type="button" class="btn btn-default">A</a>
                    <a href="{{url('unit/'.$idService.'/services/b')}}" type="button" class="btn btn-default">B</a>
                    <a href="{{url('unit/'.$idService.'/services/c')}}" type="button" class="btn btn-default">C</a>
                    <a href="{{url('unit/'.$idService.'/services/d')}}" type="button" class="btn btn-default">D</a>
                    <a href="{{url('unit/'.$idService.'/services/e')}}" type="button" class="btn btn-default">E</a>
                    <a href="{{url('unit/'.$idService.'/services/f')}}" type="button" class="btn btn-default">F</a>
                    <a href="{{url('unit/'.$idService.'/services/g')}}" type="button" class="btn btn-default">G</a>
                    <a href="{{url('unit/'.$idService.'/services/h')}}" type="button" class="btn btn-default">H</a>
                    <a href="{{url('unit/'.$idService.'/services/i')}}" type="button" class="btn btn-default">I</a>
                    <a href="{{url('unit/'.$idService.'/services/j')}}" type="button" class="btn btn-default">J</a>
                    <a href="{{url('unit/'.$idService.'/services/k')}}" type="button" class="btn btn-default">K</a>
                    <a href="{{url('unit/'.$idService.'/services/l')}}" type="button" class="btn btn-default">L</a>
                    <a href="{{url('unit/'.$idService.'/services/m')}}" type="button" class="btn btn-default">M</a>
                    <a href="{{url('unit/'.$idService.'/services/n')}}" type="button" class="btn btn-default">N</a>
                    <a href="{{url('unit/'.$idService.'/services/ñ')}}" type="button" class="btn btn-default">Ñ</a>
                    <a href="{{url('unit/'.$idService.'/services/o')}}" type="button" class="btn btn-default">O</a>
                    <a href="{{url('unit/'.$idService.'/services/p')}}" type="button" class="btn btn-default">P</a>
                    <a href="{{url('unit/'.$idService.'/services/q')}}" type="button" class="btn btn-default">Q</a>
                    <a href="{{url('unit/'.$idService.'/services/r')}}" type="button" class="btn btn-default">R</a>
                    <a href="{{url('unit/'.$idService.'/services/s')}}" type="button" class="btn btn-default">S</a>
                    <a href="{{url('unit/'.$idService.'/services/t')}}" type="button" class="btn btn-default">T</a>
                    <a href="{{url('unit/'.$idService.'/services/u')}}" type="button" class="btn btn-default">U</a>
                    <a href="{{url('unit/'.$idService.'/services/v')}}" type="button" class="btn btn-default">V</a>
                    <a href="{{url('unit/'.$idService.'/services/w')}}" type="button" class="btn btn-default">W</a>
                    <a href="{{url('unit/'.$idService.'/services/x')}}" type="button" class="btn btn-default">X</a>
                    <a href="{{url('unit/'.$idService.'/services/y')}}" type="button" class="btn btn-default">Y</a>
                    <a href="{{url('unit/'.$idService.'/services/z')}}" type="button" class="btn btn-default">Z</a>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="col-md-12 mtop32">
        <div class="panel shadow">

            <div class="header">
                <h2 class="title"><i class="fas fa-laptop-house"></i> Listado de Servicios</h2>
                <ul>
                    <li>
                        <a href="{{ url('/inicio/todas') }}" ><i class="fas fa-arrow-circle-left"></i> Regresar</a>
                    </li>
                    <li>
                        <a href="#" id="btn_search" ><i class="fas fa-search"></i> Buscar</a>
                    </li>
                </ul>
            </div>

            <div class="inside">
                <div class="form_search" id="form_search">
                    {!! Form::open(['url'=> 'unit/'.$idService.'/service/search']) !!}
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name">Ingrese dato a buscar:</label>
                            {!! Form::text('search', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="col-md-4">
                            <label for="name">Seleccione un criterio de busqueda:</label>
                            {!! Form::select('filter',['0'=>'Nombre del Servicio', '1' => 'Numero de Extensión', '2' => 'Ubicación de Extensión'], 0, ['class' => 'form-select']) !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::submit('Buscar', ['class'=>'btn btn-primary mtop16']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                
                <table class="table table-striped table-hover mtop16">
                    <thead>
                        <tr>
                            <td width="480px">UNIDAD</td>
                            <td width="480px">SERVICIO</td>
                            <td width="480px">OPCIONES</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $ser)
                            <tr>
                                <td>{{ $ser->unit->name}}</td>
                                <td>{{ $ser->name }}</td>
                                <td>
                                <div class="opts">
                                        <a href="{{ url('/services/'.$ser->id.'/telephone_extensions') }}" data-toogle="tooltrip" data-placement="top" title="Ver"><i class="fas fa-eye"> Ver</i></a>
                                </div>
                                </td>
                            </tr>
                        @endforeach

                        
                    </tbody>
                </table>

                <div class="d-flex justify-content-center btn-paginate">
                    {!! $services->render() !!}
                </div>
            </div>

        </div>

    </div>

@endsection