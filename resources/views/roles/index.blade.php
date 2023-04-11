@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-center">
                <h1>Reto Laravel BigSmart - UserCrud</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('roles.create') }}"> Crear nuevo rol</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @elseif($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nombre</th>
{{--            <th>Email</th>--}}
            <th width="280px">Opciones</th>
        </tr>
        @foreach ($roles as $key=>$role)
            <tr>
                <td>{{ $key + 1}}</td>
                <td>{{ $role->name }}</td>
{{--                <td>{{ $role->email }}</td>--}}
                <td>
                    <form action="{{ route('roles.destroy',$role->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Ver</a>

                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Editar</a>

                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $roles->links() !!}

@endsection
