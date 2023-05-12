@extends('adminlte::page')

@section('title', 'Cadastrar Novo Usuário')

@section('content_header')
<h1>Cadastrar Novo Usuário</h1>

@stop

@section('content')

    <div class="card">
        <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST" class="form">
                    @csrf

                    @include('admin.pages.users._partials.form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                </div>
                </form>
        </div>
    </div>

@stop

