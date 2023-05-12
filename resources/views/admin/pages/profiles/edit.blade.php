@extends('adminlte::page')

@section('title', "Editar  Pefil {$profile->name} ")

@section('content_header')
<h1>Editar Perfil {{ $profile->name }}</h1>

@stop

@section('content')

    <div class="card">
        <div class="card-body">
                <form action="{{ route('profiles.update', $profile->id) }}" method="POST" class="form">

                    @method('PUT')

                    @include('admin.pages.profiles._partials.form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-warning">Editar</button>
                </div>
                </form>
        </div>
    </div>

@stop

