@extends('adminlte::page')

@section('title', 'Cadastrar Novo Plano')

@section('content_header')
<h1>Cadastrar Novo Plano</h1>

@stop

@section('content')
    
    <div class="card">
        <div class="card-body">
                <form action="{{ route('plans.store') }}" method="POST" class="form">
                    @csrf
                    
                    @include('admin.pages.plans._partials.form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                </div>
                </form>
        </div>
    </div>

@stop

