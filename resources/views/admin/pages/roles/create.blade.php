@extends('adminlte::page')

@section('title', 'Cadastrar Novo Cargo')

@section('content_header')
<h1>Cadastrar Novo Cargo</h1>

@stop

@section('content')

    <div class="card">
        <div class="card-body">
                <form action="{{ route('roles.store') }}" method="POST" class="form">

                    @include('admin.pages.roles._partials.form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                </div>
                </form>
        </div>
    </div>

@stop

