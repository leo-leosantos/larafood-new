@extends('adminlte::page')

@section('title', 'Cadastrar Novo Pefil')

@section('content_header')
<h1>Cadastrar Novo Perfil</h1>

@stop

@section('content')

    <div class="card">
        <div class="card-body">
                <form action="{{ route('profiles.store') }}" method="POST" class="form">

                    @include('admin.pages.profiles._partials.form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                </div>
                </form>
        </div>
    </div>

@stop

