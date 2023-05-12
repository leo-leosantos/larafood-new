@extends('adminlte::page')

@section('title', 'Perfis')

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.index') }}" >Perfis</a></li>

    </ol>
    <h1>Perfis -  <a href="{{ route('profiles.create') }}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD </a> </h1>


@stop

@section('content')


    <div class="card">
        <div class="card-header">

            <form action="{{ route('profiles.search') }}" method="post" class="form form-inline">
                @csrf
                    <div class="form-group">
                        <input type="text" name="filter" placeholder="Pesquisar" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                    </div>
                <button type="submit" class=" btn btn-dark">Filtrar</button>

            </form>

        </div>
        <div class="card-body">
            @include('admin.includes.alerts')

            <table class="table table-condensed">
                <thead>
                    <th>#</th>

                    <th>Nome</th>
                    <th width= "290" >Ações</th>

                </thead>
                    <tbody>
                        @foreach ( $profiles as $profile )
                            <tr>
                                <td> {{ $profile->id }}</td>
                                <td> {{ $profile->name }}</td>
                                <td style="width: 10px;">
                                    <a href="{{ route('profiles.show', $profile->id) }}" class="btn btn-info">Ver</a>
                                    <a href="{{ route('profiles.edit', $profile->id) }}" class="btn btn-warning">Editar</a>
                                    <a href="{{ route('profiles.permissions', $profile->id) }}" class="btn btn-primary"><i class="fas fa-lock"></i></a>
                                    <a href="{{ route('profiles.plans', $profile->id) }}" class="btn btn-secondary"><i class="fas fa-list-alt"></i></a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>

        <div class="card-footer">

            @if (isset($filters))

                {!! $profiles->appends($filters)->links() !!}

                else
                {!! $profiles->links() !!}

            @endif
        </div>
    </div>


@stop

