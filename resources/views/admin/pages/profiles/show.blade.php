@extends('adminlte::page')

@section('title', "Detalhes do Perfil {$profile->name}")

@section('content_header')
<h1>Detalhes  Perfil   <b> {{ $profile->name }} </b</h1>

@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <ul>
                <li><strong>Nome: {{ $profile->name }}</strong></li>
                <li><strong>Descrição: {{ $profile->description }}</strong></li>

            </ul>
            @include('admin.includes.alerts')

            <form action="{{ route('profiles.destroy', $profile->id) }}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar o perfil {{ $profile->name }}</button>
            </form>
        </div>
    </div>
@stop

