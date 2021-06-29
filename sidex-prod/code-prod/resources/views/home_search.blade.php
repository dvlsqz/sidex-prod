@extends('master')
@section('title','Inicio')
@section('content')

<section>
    <div class="home_action_bar shadow">
        <div class="row">

            <div class="col-md-3">
                <div class="categories">
                    <a href="#"><i class="fas fa-stream"></i> Filtar</a>
                    <ul class="shadow">
                            <li>
                                <a href="{{ url('/inicio/todas') }}"> Todas las Unidades </a>
                                <a href="{{ url('/inicio/0') }}"> Unidades Hospitalarias </a>
                                <a href="{{ url('/inicio/1') }}"> Unidades Departamentales </a>
                            </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-9">
                {!! Form::open(['url' => '/inicio/todas/search']) !!}
                    <div class="input-group">
                        <i class="fas fa-search"></i>
                        {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => '¿Buscas algo?', 'required']) !!}
                        {!! Form::submit('Buscar', ['class'=>'btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>

        
    </div>
</section>

<div class="col-md-12 mtop32">
    <div class="panel shadow">

        <div class="header">
            <h2 class="title"><i class="fas fa-laptop-house"></i> Listado de Unidades Hospitalarias o Departamentales</h2>
        </div>

        <div class="inside">
             <table class="table table-striped table-hover mtop16">
                <thead>
                    <tr>
                        <td width="480px">UNIDAD</td>
                        <td width="480px">PBX</td>
                        <td width="480px">VER LISTADO</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($units as $u)
                        <tr>
                            <td>{{ $u->name}}</td>
                            <td>{{ $u->phone }}</td>
                            <td>
                            <div class="opts">
                                <a href="{{ url('/unit/'.$u->id.'/services/todos') }}"><i class="fas fa-eye"></i></a>
                            </div>
                            </td>
                        </tr>
                    @endforeach                    
                </tbody>
            </table>
            <div class="d-flex justify-content-center btn-paginate">
                    {!! $units->render() !!}
                </div>
        </div>

    </div>

</div>


@endsection