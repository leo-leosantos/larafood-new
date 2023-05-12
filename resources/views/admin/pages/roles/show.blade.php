@extends('adminlte::page')

@section('title', "Detalhes do Cargo {$role->name}")

@section('content_header')
<h1>Detalhes  Cargo   <b> {{ $role->name }} </b</h1>

@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <ul>
                <li><strong>Nome: {{ $role->name }}</strong></li>
                <li><strong>Descrição: {{ $role->description }}</strong></li>

            </ul>
            @include('admin.includes.alerts')

            <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar o Cargo {{ $role->name }}</button>
            </form>
        </div>
    </div>
@stop

