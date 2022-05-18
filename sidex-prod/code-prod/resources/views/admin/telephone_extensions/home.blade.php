@extends('admin.master')
@section('title','Extensiones Telefonicas')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/telephone_extensions/1') }}" class="nav-link"><i class="fas fa-phone-square-alt"></i> Extensiones Telefonicas</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-phone-square-alt"></i> Extensiones Telefonicas</h2>
                <ul>
                    @if(kvfj(Auth::user()->permissions, 'telephone_extension_add'))
                        <li>
                            <a href="{{ url('/admin/telephone_extension/add') }}" ><i class="fas fa-plus-circle"></i> Agregar Extension Telefonica</a>
                        </li>
                    @endif
                    <li>
                        <a href="#"><i class="fas fa-chevron-down"></i> Filtar</a>
                        <ul class="shadow">
                            <li><a href="{{url('/admin/telephone_extensions/1')}}"><i class="fas fa-eye"></i> Públicas</a></li>
                            <li><a href="{{url('/admin/telephone_extensions/0')}}"><i class="fas fa-eye-slash"></i> No Públicas</a></li>
                            <li><a href="{{url('/admin/telephone_extensions/trash')}}"><i class="fas fa-trash"></i> Borradas</a></li>
                            <li><a href="{{url('/admin/telephone_extensions/all')}}"><i class="fas fa-list-ul"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" id="btn_search" ><i class="fas fa-search"></i> Buscar</a>
                        
                    </li>
                    @if(kvfj(Auth::user()->permissions, 'report_user'))
                        <li>
                            <a href="{{ url('/admin/report_listado_extensiones') }}" data-toogle="tooltrip" data-placement="top" title="Generar"><i class="fas fa-print"></i> Imprimir Listado</a>
                        </li>
                    @endif
                    @if(kvfj(Auth::user()->permissions, 'report_informatica'))
                        <li>
                            <a href="{{ url('/admin/report_informatica') }}" data-toogle="tooltrip" data-placement="top" title="Generar"><i class="fas fa-print"></i> Imprimir R.I</a>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="inside">
                <div class="form_search" id="form_search">
                    {!! Form::open(['url'=> '/admin/telephone_extension/search']) !!}
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su busqueda', 'required']) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::select('filter',['0'=>'Numero de Extension', '1'=>'Descripcion de Extension', '2'=>'Direccion IP'], 0, ['class' => 'form-select']) !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::select('status',['0'=>'No Pública', '1'=>'Pública'], 0, ['class' => 'form-select']) !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::submit('Buscar', ['class'=>'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                
                
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td>OPCIONES</td>
                            <td>ID</td>
                            <td>NUMERO</td>
                            <td>UBICACIÓN</td>
                            <td>SERVICIO</td>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @foreach($telephone_extensions as $te)
                            @if(Auth::user()->role == "0")
                                <tr>
                                    <td width="140">
                                        <div class="opts">
                                            @if(kvfj(Auth::user()->permissions, 'telephone_extension_edit'))
                                                <a href="{{ url('/admin/telephone_extension/'.$te->id.'/edit') }}" data-toogle="tooltrip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                            @endif                                        
                                            @if(kvfj(Auth::user()->permissions, 'telephone_extension_delete'))
                                                @if(is_null($te->deleted_at))
                                                    <a href="#" data-action="delete" data-path="admin/telephone_extension" data-object="{{ $te->id }}" data-toogle="tooltrip" data-placement="top" title="Eliminar" class="btn-deleted"><i class="fas fa-trash-alt"></i></a>
                                                @else
                                                    <a href="{{ url('/admin/telephone_extension/'.$te->id.'/restore') }}" data-action="restore" data-path="admin/telephone_extension" data-object="{{ $te->id }}" data-toogle="tooltrip" data-placement="top" title="Restaurar" class="btn-deleted"><i class="fas fa-trash-restore"></i></a>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                    <td width="50">{{ $te->id }}</td>
                                    <td>{{ $te->number }} @if($te->status == "0") <i class="fas fa-eye-slash" data-toogle="tooltrip" data-placement="top" title="Estado: No Pública"></i> @endif </td>
                                    <td>{{ $te->description }}</td>
                                    <td>{{ $te->ser->name }}</td>
                                </tr>
                            @elseif(Auth::user()->role == "1")
                                @foreach($assig_unit as $au)
                                    @if( $te->ser->unit_id == $au->unit_id)
                                    <tr>
                                        <td width="140">
                                            <div class="opts">
                                                @if(kvfj(Auth::user()->permissions, 'telephone_extension_edit'))
                                                    <a href="{{ url('/admin/telephone_extension/'.$te->id.'/edit') }}" data-toogle="tooltrip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                                @endif                                        
                                                @if(kvfj(Auth::user()->permissions, 'telephone_extension_delete'))
                                                    @if(is_null($te->deleted_at))
                                                        <a href="#" data-action="delete" data-path="admin/telephone_extension" data-object="{{ $te->id }}" data-toogle="tooltrip" data-placement="top" title="Eliminar" class="btn-deleted"><i class="fas fa-trash-alt"></i></a>
                                                    @else
                                                        <a href="{{ url('/admin/telephone_extension/'.$te->id.'/restore') }}" data-action="restore" data-path="admin/telephone_extension" data-object="{{ $te->id }}" data-toogle="tooltrip" data-placement="top" title="Restaurar" class="btn-deleted"><i class="fas fa-trash-restore"></i></a>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                        <td width="50">{{ $te->id }}</td>
                                        <td>{{ $te->number }} @if($te->status == "0") <i class="fas fa-eye-slash" data-toogle="tooltrip" data-placement="top" title="Estado: No Pública"></i> @endif </td>
                                        <td>{{ $te->description }}</td>
                                        <td>{{ $te->ser->name }}</td>
                                    </tr>
                                    @endif
                                @endforeach
                            @else
                                @foreach($assig_service as $ae)
                                    @if($ae->service_id == $te->service_id)
                                        <tr>
                                            <td width="140">
                                                <div class="opts">
                                                    @if(kvfj(Auth::user()->permissions, 'telephone_extension_edit'))
                                                        <a href="{{ url('/admin/telephone_extension/'.$te->id.'/edit') }}" data-toogle="tooltrip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                                    @endif                                        
                                                    @if(kvfj(Auth::user()->permissions, 'telephone_extension_delete'))
                                                        @if(is_null($te->deleted_at))
                                                            <a href="#" data-action="delete" data-path="admin/telephone_extension" data-object="{{ $te->id }}" data-toogle="tooltrip" data-placement="top" title="Eliminar" class="btn-deleted"><i class="fas fa-trash-alt"></i></a>
                                                        @else
                                                            <a href="{{ url('/admin/telephone_extension/'.$te->id.'/restore') }}" data-action="restore" data-path="admin/telephone_extension" data-object="{{ $te->id }}" data-toogle="tooltrip" data-placement="top" title="Restaurar" class="btn-deleted"><i class="fas fa-trash-restore"></i></a>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                            <td width="50">{{ $te->id }}</td>
                                            <td>{{ $te->number }} @if($te->status == "0") <i class="fas fa-eye-slash" data-toogle="tooltrip" data-placement="top" title="Estado: No Pública"></i> @endif </td>
                                            <td>{{ $te->description }}</td>
                                            <td>{{ $te->ser->name }}</td>
                                        </tr>
                                    @else
                                    
                                    @endif
                                @endforeach
                            @endif


                           
                        @endforeach
                        
                    </tbody>
                </table>

                <tr>
                    <td colspan="6">
                        @if(Auth::user()->role == "0")
                            {!! $telephone_extensions->render() !!}
                        @endif 
                        
                    </td>
                </tr>
                
            </div>

        </div>
    </div>

@endsection