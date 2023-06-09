@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tables.index') }}" class="active">Mesas</a></li>

    </ol>
    <h1>Mesas - <a href="{{ route('tables.create') }}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD
        </a> </h1>


@stop

@section('content')


    <div class="card">
        <div class="card-header">

            <form action="{{ route('tables.search') }}" method="post" class="form form-inline">
                @csrf
                <div class="form-group">
                    <input type="text" name="filter" placeholder="Pesquisar" class="form-control"
                        value="{{ $filters['filter'] ?? '' }}">
                </div>
                <button type="submit" class=" btn btn-dark">Filtrar</button>

            </form>

        </div>
        <div class="card-body">
            @include('admin.includes.toastr')

            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Identify</th>
                        <th>Descrição</th>
                        <th width="190">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tables as $table)
                        <tr>
                            <td> {{ $table->id }}</td>
                            <td> {{ $table->identify }}</td>
                            <td> {{ $table->description }}</td>

                            <td style="width: 10px;">
                                <a href="{{ route('tables.qrcode', $table->uuid) }}" class="btn btn-default" target="_blank"><i class=" fas fa-qrcode"></i></a>

                                <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-warning">Editar</a>
                                <a href="{{ route('tables.show', $table->id) }}" class="btn btn-info">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">

            @if (isset($filters))
                {!! $tables->appends($filters)->links() !!}
            @else
                {!! $tables->links() !!}
            @endif
        </div>
    </div>


@stop
