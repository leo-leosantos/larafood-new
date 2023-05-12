@extends('adminlte::page')

@section('title', "Editar o Categoria {$table->identify} ")

@section('content_header')
<h1>Editar a Mesa {{ $table->identify }}</h1>

@stop

@section('content')

    <div class="card">
        <div class="card-body">
                <form action="{{ route('tables.update', $table->id) }}" method="POST" class="form">
                    @csrf
                    @method('PUT')

                        @include('admin.pages.tables._partials.form')
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning">Editar</button>
                    </div>

                </form>
        </div>
    </div>

@stop

