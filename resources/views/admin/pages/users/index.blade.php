@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('users.index') }}" >Usuários</a></li>

    </ol>
    <h1>Usuários -  <a href="{{ route('users.create') }}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD </a> </h1>


@stop

@section('content')


    <div class="card">
        <div class="card-header">

            <form action="{{ route('users.search') }}" method="post" class="form form-inline">
                @csrf
                    <div class="form-group">
                        <input type="text" name="filter" placeholder="Pesquisar" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                    </div>
                <button type="submit" class=" btn btn-dark">Filtrar</button>

            </form>

        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <th>#</th>

                    <th>Nome</th>
                    <th>E-mail</th>
                    <th width= "290" >Ações</th>

                </thead>
                @foreach ( $users as $user )
                    <tbody>
                        <td> {{ $user->id }}</td>
                        <td> {{ $user->name }}</td>
                        <td> {{ $user->email }}</td>

                        <td style="width: 10px;">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Editar</a>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('users.roles', $user->id) }}" class="btn btn-success" title="Cargos"><i class="fas fa-card"></i>Cargos</a>

                        </td>
                    </tbody>
                @endforeach

            </table>
        </div>

        <div class="card-footer">

            @if (isset($filters))

                {!! $users->appends($filters)->links() !!}

                @else
                {!! $users->links() !!}

            @endif
        </div>
    </div>


@stop

