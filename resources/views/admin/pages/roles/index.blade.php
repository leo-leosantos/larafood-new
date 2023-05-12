@extends('adminlte::page')

@section('title', 'Cargos')

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('roles.index') }}" >Cargos</a></li>

    </ol>
    <h1>Cargos -  <a href="{{ route('roles.create') }}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD </a> </h1>


@stop

@section('content')


    <div class="card">
        <div class="card-header">

            <form action="{{ route('roles.search') }}" method="post" class="form form-inline">
                @csrf
                    <div class="form-group">
                        <input type="text" name="filter" placeholder="Pesquisar" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                    </div>
                <button type="submit" class=" btn btn-dark">Filtrar</button>

            </form>

        </div>
        <div class="card-body">
            @include('admin.includes.toastr')

            <table class="table table-condensed">
                <thead>
                    <th>#</th>

                    <th>Nome</th>
                    <th width= "290" >Ações</th>

                </thead>
                    <tbody>
                        @foreach ( $roles as $role )
                            <tr>
                                <td> {{ $role->id }}</td>
                                <td> {{ $role->name }}</td>
                                <td style="width: 10px;">
                                    <a href="{{ route('roles.show', $role->id) }}" class="btn btn-info">Ver</a>
                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">Editar</a>
                                    <a href="{{ route('roles.permissions', $role->id) }}" class="btn btn-primary"><i class="fas fa-lock"></i></a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>

        <div class="card-footer">

            @if (isset($filters))

                {!! $roles->appends($filters)->links() !!}

                else
                {!! $roles->links() !!}

            @endif
        </div>
    </div>


@stop

