@extends('adminlte::page')

@section('title', 'Cadastrar Nova Empresa')

@section('content_header')
<h1>Cadastrar Nova Empresa</h1>

@stop

@section('content')

    <div class="card">
        <div class="card-body">
                <form action="{{ route('tenants.store') }}" method="POST" class="form" enctype="multipart/form-data">
                    @csrf

                    @include('admin.pages.tenants._partials.form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                </div>
                </form>
        </div>
    </div>

@stop

