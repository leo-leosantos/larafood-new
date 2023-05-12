@extends('adminlte::page')

@section('title', "Permissões do Cargo {$role->name}")

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('roles.index') }}" class="active">Cargo</a></li>

    </ol>
    <h1>Permissões do Cargo: <strong> {{ $role->name }} </strong> -
        <a href="{{ route('roles.permissions.available', $role->id) }}" class="btn btn-dark"><i
                class="fas fa-plus-square"></i> ADD NOVA PERMISSÃO </a>
    </h1>


@stop

@section('content')


    <div class="card">
        <div class="card-body">
            @include('admin.includes.toastr')
            <table class="table table-condensed">
                <thead>
                    <th>#</th>
                    <th>Nome</th>
                    <th width="50">Ações</th>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td> {{ $permission->id }}</td>
                            <td> {{ $permission->name }}</td>
                            <td style="width: 10px;">
                                <a href="{{ route('roles.permissions.detach', [$role->id,$permission->id ]) }}" class="btn btn-danger">DESVINCULAR</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">

            @if (isset($filters))
                {!! $permissions->appends($filters)->links() !!}

                @else
                {!! $permissions->links() !!}
            @endif
        </div>
    </div>


@stop
