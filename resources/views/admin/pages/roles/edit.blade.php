@extends('adminlte::page')

@section('title', "Editar  Cargo {$role->name} ")

@section('content_header')
<h1>Editar Cargo {{ $role->name }}</h1>

@stop

@section('content')

    <div class="card">
        <div class="card-body">
                <form action="{{ route('roles.update', $role->id) }}" method="POST" class="form">

                    @method('PUT')

                    @include('admin.pages.roles._partials.form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-warning">Editar</button>
                </div>
                </form>
        </div>
    </div>

@stop

