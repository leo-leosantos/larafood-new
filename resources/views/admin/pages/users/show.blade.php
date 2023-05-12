@extends('adminlte::page')

@section('title', "Detalhes do Usuário {$user->name}")

@section('content_header')
<h1>Detalhes  Usuário  <b> {{ $user->name }} </b</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li><strong>Nome: {{ $user->name }}</strong></li>
                <li><strong>E-mail: {{ $user->email }}</strong></li>
                <li><strong>Empresa: {{ $user->tenant->name }}</strong></li>
            </ul>
            @include('admin.includes.alerts')
            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar o Usuário {{ $user->name }}</button>
            </form>
        </div>
    </div>
@stop

