@extends('adminlte::page')

@section('title', 'Cadastrar Novo Produto')

@section('content_header')
<h1>Cadastrar Novo Produto</h1>

@stop

@section('content')

    <div class="card">
        <div class="card-body">
                <form action="{{ route('products.store') }}" method="POST" class="form" enctype="multipart/form-data">
                    @csrf

                    @include('admin.pages.products._partials.form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                </div>
                </form>
        </div>
    </div>

@stop

