@extends('adminlte::page')

@section('title', "usuários disponíveis Cargo {$user->name}")

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('users.index') }}" class="active">Usuários</a></li>

    </ol>
    <h1>usuários disponíveis Cargo: <strong> {{ $user->name }} </strong> </h1>

@stop

@section('content')


    <div class="card">
        <div class="card-header">

            <form action="{{ route('users.roles.available', $user->id) }}" method="post" class="form form-inline">
                @csrf
                <div class="form-group">
                    <input type="text" name="filter" placeholder="Pesquisar" class="form-control"
                        value="{{ $filters['filter'] ?? '' }}">
                </div>
                <button type="submit" class=" btn btn-dark">Filtrar</button>

            </form>

        </div>
        <div class="card-body">

            <table class="table table-condensed">
                <thead>
                    <th>id</th>
                    <th width="50px">#</th>
                    <th>Nome</th>
                </thead>
                <tbody>
                    <form action="{{ route('users.roles.attach', $user->id) }}" method="POST">
                        @csrf

                        @foreach ($roles as $role)
                            <tr>
                                <td> {{ $role->id }}</td>

                                <td>
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                        id="">
                                </td>

                                <td> {{ $role->name }}</td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="500">

                                @include('admin.includes.toastr')
                                    <button type="submit" class=" btn btn-success">Vincular</button>
                            </td>
                        </tr>
                    </form>
                </tbody>

            </table>
        </div>

        <div class="card-footer">

            @if (isset($filters))
                {!! $roles->appends($filters)->links() !!}

                @else
                {!! $roles->links() !!}
            @endif
        </div>
    </div>


@stop
