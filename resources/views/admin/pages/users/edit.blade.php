@extends('adminlte::page')

@section('title', "Editar o Usuário {$user->name} ")

@section('content_header')
<h1>Editar o Usuário {{ $user->name }}</h1>

@stop

@section('content')

    <div class="card">
        <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST" class="form">
                    @csrf
                    @method('PUT')

                        @include('admin.pages.users._partials.form')
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning">Editar</button>
                    </div>

                </form>
        </div>
    </div>

@stop

