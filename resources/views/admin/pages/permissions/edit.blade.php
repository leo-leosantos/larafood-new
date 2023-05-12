@extends('adminlte::page')

@section('title', "Editar  Permissão {$permission->name} ")

@section('content_header')
<h1>Editar Permissão {{ $permission->name }}</h1>

@stop

@section('content')

    <div class="card">
        <div class="card-body">
                <form action="{{ route('permissions.update', $permission->id) }}" method="POST" class="form">

                    @method('PUT')

                    @include('admin.pages.permissions._partials.form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-warning">Editar</button>
                </div>
                </form>
        </div>
    </div>

@stop

