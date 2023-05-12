@extends('adminlte::page')

@section('title', "Detalhes do Produto {$product->title}")

@section('content_header')
<h1>Detalhes do Produto  <b> {{ $product->title }} </b</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                  <img src="{{ url("storage/{$product->image}" ) }}" alt="{{ $product->title }}"
                    style="max-width: 90px;">

                <li><strong>Title: </strong> {{ $product->title }}</li>
                <li><strong>Flag:</strong> {{ $product->flag }}</li>
                <li><strong>Descrição:</strong> {{ $product->description }}</li>
            </ul>
            @include('admin.includes.alerts')


            <form action="{{ route('products.destroy', $product->id) }}"  method="post">
                @method('DELETE')
                @csrf
                <a href="{{ route('products.destroy', $product->id) }}"  class="btn btn-danger" title="Delete Data" >
                    <i class="fas fa-trash"></i>Deletar o Produto: {{ $product->title }}
                </a>
             </form>
        </div>
    </div>
@stop

