@extends('admin.master')
@section('title','Servicios')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/services') }}" class="nav-link"><i class="fas fa-laptop-house"></i> Servicios</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-5">
                @if(kvfj(Auth::user()->permissions, 'service_add'))
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-plus-circle"></i> Agregar Servicio</h2>
                        </div>

                        <div class="inside">
                                {!! Form::open(['url' => '/admin/service/add']) !!}
                                    <label for="name">Nombre:</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <label for="unit_id"  class="mtop16">Unidad a la que pertence:</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                        <select name="unit_id" class="form-select" >
                                        @if(Auth::user()->role != 0)
                                            @foreach($assig_units as $au)
                                                @foreach($units as $u)
                                                    @if($au->user_id == Auth::user()->id && $au->unit_id == $u->id)
                                                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @else
                                            @foreach($units as $u)
                                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                            @endforeach
                                        @endif
                                        </select>
                                    </div>

                                    {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}

                                {!! Form::close() !!}
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-7">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-laptop-house"></i> Services</a>
                    </div>

                    <div class="inside">
                        <table class="table table-striped table-hover mtop16">
                            <thead>
                                <tr>
                                    <td width="140px">OPCIONES</td>
                                    <td width="48px">SERVICIO</td>
                                    <td>UNIDAD</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($services as $ser)
                                    @if(Auth::user()->role == "0")
                                        <tr>
                                            <td>
                                            <div width="48" class="opts">
                                                @if(kvfj(Auth::user()->permissions, 'service_edit'))
                                                    <a href="{{ url('/admin/service/'.$ser->id.'/edit') }}" data-toogle="tooltrip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                                @endif
                                                @if(kvfj(Auth::user()->permissions, 'service_delete'))
                                                    <a href="{{ url('/admin/service/'.$ser->id.'/delete') }}" data-toogle="tooltrip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                                @endif
                                            </div>
                                            </td>
                                            <td width="200">{{ $ser->name }}</td>
                                            <td width="50">{{ $ser->unit->name}}</td>
                                        </tr>
                                    @elseif(Auth::user()->role == "1")
                                        @foreach($assig_unit as $au)
                                            @if($au->user_id == Auth::user()->id && $au->unit_id == $ser->unit_id )
                                                <tr>
                                                    <td>
                                                    @if(kvfj(Auth::user()->permissions, 'service_edit'))
                                                        <div width="48" class="opts">
                                                            @if(kvfj(Auth::user()->permissions, 'service_edit'))
                                                                <a href="{{ url('/admin/service/'.$ser->id.'/edit') }}" data-toogle="tooltrip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                                            @endif
                                                            @if(kvfj(Auth::user()->permissions, 'service_delete'))
                                                                <a href="{{ url('/admin/service/'.$ser->id.'/delete') }}" data-toogle="tooltrip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                                            @endif
                                                        </div>
                                                    @endif
                                                    </td>
                                                    <td width="200">{{ $ser->name }}</td>
                                                    <td width="50">{{ $ser->unit->name}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else                                        
                                        @foreach($assig_service as $ae)
                                            @if($ae->user_id == Auth::user()->id && $ae->service_id == $ser->id)
                                                <tr>
                                                    <td>
                                                    @if(kvfj(Auth::user()->permissions, 'service_edit'))
                                                        <div width="48" class="opts">
                                                            @if(kvfj(Auth::user()->permissions, 'service_edit'))
                                                                <a href="{{ url('/admin/service/'.$ser->id.'/edit') }}" data-toogle="tooltrip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                                            @endif
                                                            @if(kvfj(Auth::user()->permissions, 'service_delete'))
                                                                <a href="{{ url('/admin/service/'.$ser->id.'/delete') }}" data-toogle="tooltrip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                                            @endif
                                                        </div>
                                                    @endif
                                                    </td>
                                                    <td width="200">{{ $ser->name }}</td>
                                                    <td width="50">{{ $ser->unit->name}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center btn-paginate">
                            @if(Auth::user()->role == "0")
                                {!! $services->render() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection