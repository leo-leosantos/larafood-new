@extends('adminlte::page')

@section('title', "Detalhes do Plano {$plan->name}")

@section('content_header')
<h1>Detalhes  Plano  <b> {{ $plan->name }} </b</h1>

@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <ul>
                <li><strong>Nome: {{ $plan->name }}</strong></li>
                <li><strong>Url: {{ $plan->url }}</strong></li>
                <li><strong>Preço: R$ {{ number_format($plan->price,2,',', '.' ) }}</strong></li>
                <li><strong>Descrição: {{ $plan->description }}</strong></li>

            </ul>
            @include('admin.includes.alerts')

            <form action="{{ route('plans.destroy', $plan->url) }}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar o plano {{ $plan->name }}</button>
            </form>
        </div>
    </div>
@stop

