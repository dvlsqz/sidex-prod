@extends('admin.master')
@section('title','Unidades')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/units/0') }}" class="nav-link"><i class="fas fa-hospital-user"></i> Unidades</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">        
        <div class="row">
            <div class="col-md-4">
                @if(kvfj(Auth::user()->permissions, 'unit_add'))
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-plus-circle"></i> Agregar Unidad</h2>
                        </div>

                        <div class="inside">
                            {!! Form::open(['url' => '/admin/unit/add', 'files' => true]) !!}
                                <label for="name">Nombre de Unidad:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                                </div>

                                <label for="code" class="mtop16">Código Administrativo:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('code', null, ['class'=>'form-control']) !!}
                                </div>

                                <label for="phone" class="mtop16">PBX de Unidad:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('phone', null, ['class'=>'form-control']) !!}
                                </div>

                                <label for="address" class="mtop16">Dirección:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('address', null, ['class'=>'form-control']) !!}
                                </div>

                                <label for="municipality_id"  class="mtop16">Municipio de Ubicación:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    {!! Form::select('municipality_id', $municipalities,1,['class'=>'form-select']) !!}
                                </div>

                                <label for="type_unit" class="mtop16">Tipo de Unidad:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    {!! Form::select('type_unit', getUnitsArray(),0,['class'=>'form-select']) !!}
                                </div>
                                
                                {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                            {!! Form::close() !!}                            
                        </div>
                    </div>
                @endif
            </div>
            
            <div class="col-md-8">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-hospital-user"></i> Unidades Hospitalarias o Departamentales</a>
                    </div>

                    <div class="inside">
                        <nav class="nav nav-pills nav-fill">
                            @foreach(getUnitsArray() as $m => $k)
                                <a class="nav-link" href="{{ url('/admin/units/'.$m) }}"><i class="fas fa-search"></i> {{ $k }}</a>
                            @endforeach
                        </nav>
                        <table class="table table-striped table-hover mtop16">
                            <thead>
                                <tr>
                                    <td width="140px">OPCIONES</td>
                                    <td>NOMBRE</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($units as $unit)
                                    @if(Auth::user()->role == "0" )
                                        <tr>
                                            <td>
                                            <div class="opts">
                                                @if(kvfj(Auth::user()->permissions, 'unit_edit'))
                                                    <a href="{{ url('/admin/unit/'.$unit->id.'/edit') }}" data-toogle="tooltrip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                                @endif
                                                @if(kvfj(Auth::user()->permissions, 'unit_delete'))
                                                    <a href="{{ url('/admin/unit/'.$unit->id.'/delete') }}" data-toogle="tooltrip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                                @endif
                                            </div>
                                            </td>
                                            <td>{{ $unit->name }}</td>
                                        </tr>
                                    @else
                                        @foreach($assig_unit as $au)
                                            @if($au->user_id == Auth::user()->id && $au->unit_id == $unit->id)
                                                <tr>
                                                    <td>
                                                        <div class="opts">
                                                            @if(kvfj(Auth::user()->permissions, 'unit_edit'))
                                                                <a href="{{ url('/admin/unit/'.$unit->id.'/edit') }}" data-toogle="tooltrip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                                            @endif
                                                            @if(kvfj(Auth::user()->permissions, 'unit_delete'))
                                                                <a href="{{ url('/admin/unit/'.$unit->id.'/delete') }}" data-toogle="tooltrip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>{{ $unit->name }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center btn-paginate">
                            @if(Auth::user()->role == "0")
                                {!! $units->render() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
@endsection