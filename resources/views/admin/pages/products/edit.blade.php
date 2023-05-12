@extends('adminlte::page')

@section('title', "Editar o Produto {$product->title} ")

@section('content_header')
<h1>Editar o Produto {{ $product->title }}</h1>

@stop

@section('content')
@include('admin.includes.alerts')

    <div class="card">
        <div class="card-body">
                <form action="{{ route('products.update', $product->id) }}" method="POST" class="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                        @include('admin.pages.products._partials.form')

                        <div class="form-group">
                            <button type="submit" class="btn btn-warning">Editar</button>
                        </div>

                </form>
        </div>
    </div>

@stop

