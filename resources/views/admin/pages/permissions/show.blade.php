@extends('adminlte::page')

@section('title', "Detalhes da Permissão {$permission->name}")

@section('content_header')
<h1>Detalhes  Permissão   <b> {{ $permission->name }} </b</h1>

@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <ul>
                <li><strong>Nome: {{ $permission->name }}</strong></li>
                <li><strong>Descrição: {{ $permission->description }}</strong></li>

            </ul>
            @include('admin.includes.alerts')

            <form action="{{ route('permissions.destroy', $permission->id) }}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar Permissão {{ $permission->name }}</button>
            </form>
        </div>
    </div>
@stop

