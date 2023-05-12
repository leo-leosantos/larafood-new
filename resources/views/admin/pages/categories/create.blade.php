@extends('adminlte::page')

@section('title', 'Cadastrar Nova Categoria')

@section('content_header')
<h1>Cadastrar Nova Categoria</h1>

@stop

@section('content')

    <div class="card">
        <div class="card-body">
                <form action="{{ route('categories.store') }}" method="POST" class="form">
                    @csrf

                    @include('admin.pages.categories._partials.form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                </div>
                </form>
        </div>
    </div>

@stop

