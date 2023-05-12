@extends('adminlte::page')

@section('title', "Perfis da permissão {$permission->name}")

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('permissions.index') }}">Permissões</a></li>

    </ol>
    <h1>Perfis da permissão: <strong> {{ $permission->name }} </strong> -

    </h1>


@stop

@section('content')


    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')
            <table class="table table-condensed">
                <thead>
                    <th>#</th>
                    <th>Nome</th>
                    <th width="50">Ações</th>
                </thead>
                <tbody>
                    @foreach ($profiles as $profile)
                        <tr>
                            <td> {{ $profile->id }}</td>
                            <td> {{ $profile->name }}</td>
                            <td style="width: 10px;">
                                <a href="{{ route('profiles.permissions.detach', [$profile->id,$permission->id ]) }}" class="btn btn-danger">DESVINCULAR</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">

            @if (isset($filters))
                {!! $profiles->appends($filters)->links() !!}

                @else
                {!! $profiles->links() !!}
            @endif
        </div>
    </div>


@stop
