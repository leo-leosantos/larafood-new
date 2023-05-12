@extends('adminlte::page')
@section('plugins.Sweetalert2', true)
@section('title', 'Tenants')

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tenants.index') }}" class="active">Empresa</a></li>

    </ol>
    <h1>Tenants - <a href="{{ route('tenants.create') }}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD
        </a> </h1>


@stop

@section('content')


    <div class="card">
        <div class="card-header">

            <form action="{{ route('tenants.search') }}" method="post" class="form form-inline">
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
                        <th style="max-width: 100px;" >Imagem</th>
                        <th>Nome</th>
                        <th width="190">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tenants as $tenant)
                        <tr>
                            <td> {{ $tenant->id }}</td>
                            <td>

                                <img src="{{ url("storage/{$tenant->logo}" ) }}" alt="{{ $tenant->name }}"
                                    style="max-width: 90px;"
                                >
                            </td>
                            <td> {{ $tenant->name }}</td>

                            <td style="width: 10px;">

                                <a href="{{ route('tenants.edit', $tenant->id) }}" class="btn btn-warning">Editar</a>
                                <a href="{{ route('tenants.show', $tenant->id) }}" class="btn btn-info">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">

            @if (isset($filters))
                {!! $tenants->appends($filters)->links() !!}
            @else
                {!! $tenants->links() !!}
            @endif
        </div>
    </div>


@stop
