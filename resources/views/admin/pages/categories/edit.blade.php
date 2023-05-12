@extends('adminlte::page')

@section('title', "Editar o Categoria {$category->name} ")

@section('content_header')
<h1>Editar o Categoria {{ $category->name }}</h1>

@stop

@section('content')
@include('admin.includes.alerts')

    <div class="card">
        <div class="card-body">
                <form action="{{ route('categories.update', $category->id) }}" method="POST" class="form">
                    @csrf
                    @method('PUT')

                        @include('admin.pages.categories._partials.form')
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning">Editar</button>
                    </div>

                </form>
        </div>
    </div>

@stop

