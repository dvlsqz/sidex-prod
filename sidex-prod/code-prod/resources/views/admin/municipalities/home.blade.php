@extends('admin.master')
@section('title','Municipios')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/municipalities') }}" class="nav-link"><i class="fas fa-globe-americas"></i> Municipios</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">

            <div class="header">
                <h2 class="title"><i class="fas fa-globe-americas"></i> Municipios</h2>
            </div>

            <div class="inside">
                
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>CODIGO</td>
                            <td>MUNICIPIO</td>
                            <td>DEPARTAMENTO</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($municipalities as $m)
                            <tr>
                                <td>{{$m->id}}</td>
                                <td>{{$m->code}}</td>
                                <td>{{$m->name}}</td>
                                <td>{{$m->department }}</td>
                            </tr>
                        @endforeach
                        <tr>                
                    </tbody>
                </table>
                <div class="d-flex justify-content-center btn-paginate">
                    @if(Auth::user()->role == "0")
                        {!! $municipalities->render() !!}
                    @endif
                </div>
            </div>
            
        </div>
    </div>

@endsection