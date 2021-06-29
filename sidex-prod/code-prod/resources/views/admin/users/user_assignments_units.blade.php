@extends('admin.master')
@section('title','Asignaciones a Usuario')

<script src="{{ asset('js/jQuery-2.1.4.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/bootstrap-select.min.js') }}" type="text/javascript"></script>

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/users') }}" class="nav-link"><i class="fas fa-user-lock"></i> Usuarios</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/users') }}" class="nav-link"><i class="fas fa-people-arrows"></i> Asignación de Unidad y Servicios de Usuario: {{ $u->name.' '.$u->lastname}} (ID: {{ $u->id}})</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            @if(kvfj(Auth::user()->permissions, 'user_assignments_units'))
                <div class="col-md-5">
                    <div class="panel shadow">

                        <div class="header">
                            <h2 class="title"><i class="fas fa-plus-circle"></i> Asignar Unidad</h2>
                        </div>

                        <div class="inside">
                            @if(kvfj(Auth::user()->permissions, 'service_add'))
                                {!! Form::open(['url' => '/admin/user/'.$u->id.'/assignments_units']) !!} 

                                    <label for="unit_id">Unidad a Asignar:</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                        <select name="unit_id" class="form-select selectpicker" data-live-search="true"  <script src="{{asset('js/bootstrap.min.js')}}"></script>>
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
                            @endif
                        </div>

                    </div>
                </div>
            @endif

            <div class="col-md-7">
                <div class="panel shadow">

                    <div class="header">
                        <h2 class="title"><i class="fas fa-laptop-house"></i> Unidades Asignadas</a>
                    </div>

                    <div class="inside">
                        <table class="table table-striped table-hover mtop16">
                            <thead>
                                <tr>
                                    <td width="140px">OPCIONES</td>
                                    <td width="48px">NOMBRE</td>
                                    <td width="48px">UNIDAD</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assig_unit as $au)
                                    <tr>
                                        <td>
                                        <div width="48" class="opts">
                                            @if(kvfj(Auth::user()->permissions, 'user_assignments_delete'))
                                                <a href="{{ url('/admin/user/assignments/unit/'.$au->id.'/delete') }}" data-toogle="tooltrip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                            @endif
                                        </div> 
                                        </td>
                                        <td width="200">{{ $au->user->name }}</td>
                                        <td width="200">{{ $au->unit->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center btn-paginate">
                            <td colspan="7"> {!! $assig_unit->render() !!}</td>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
@endsection