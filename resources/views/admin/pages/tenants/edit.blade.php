@extends('adminlte::page')

@section('title', "Editar o Empresa {$tenant->name} ")

@section('content_header')
<h1>Editar o Empresa {{ $tenant->name }}</h1>

@stop

@section('content')
@include('admin.includes.alerts')

    <div class="card">
        <div class="card-body">
                <form action="{{ route('tenants.update', $tenant->id) }}" method="POST" class="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                        @include('admin.pages.tenants._partials.form')

                        <div class="form-group">
                            <button type="submit" class="btn btn-warning">Editar</button>
                        </div>

                </form>
        </div>
    </div>

@stop

