@extends('adminlte::page')
@section('plugins.Sweetalert2', true)
@section('title', 'Produtos')

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}" class="active">Produtos</a></li>

    </ol>
    <h1>Produtos - <a href="{{ route('products.create') }}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD
        </a> </h1>


@stop

@section('content')


    <div class="card">
        <div class="card-header">

            <form action="{{ route('products.search') }}" method="post" class="form form-inline">
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
                        <th>Titulo</th>
                        <th>Descrição</th>
                        <th width="190">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td> {{ $product->id }}</td>
                            <td>

                                <img src="{{ url("storage/{$product->image}" ) }}" alt="{{ $product->title }}"
                                    style="max-width: 90px;"
                                >
                            </td>
                            <td> {{ $product->title }}</td>
                            <td> {{ $product->description }}</td>

                            <td style="width: 10px;">
                                <a href="{{ route('products.categories', $product->id) }}" class="btn btn-warning" title="Categorias"><i class="fas fa-layer-group"></i></a>

                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Editar</a>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">

            @if (isset($filters))
                {!! $products->appends($filters)->links() !!}
            @else
                {!! $products->links() !!}
            @endif
        </div>
    </div>


@stop
