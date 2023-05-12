@extends('adminlte::page')

@section('title', "Detalhes do Categoria {$category->name}")

@section('content_header')
<h1>Detalhes  Categoria  <b> {{ $category->name }} </b</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li><strong>Nome: </strong> {{ $category->name }}</li>
                <li><strong>URL:</strong> {{ $category->url }}</li>
                <li><strong>Descrição:</strong> {{ $category->description }}</li>
            </ul>
            @include('admin.includes.alerts')
            <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar a Categoria {{ $category->name }}</button>
            </form>
        </div>
    </div>
@stop

