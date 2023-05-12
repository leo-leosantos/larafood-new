@extends('adminlte::page')

@section('title', "Editar o Plano {$plan->name} ")

@section('content_header')
<h1>Editar o Plano {{ $plan->name }}</h1>

@stop

@section('content')
    
    <div class="card">
        <div class="card-body">
                <form action="{{ route('plans.update', $plan->url) }}" method="POST" class="form">
                    @csrf
                    @method('PUT')
                    
                        @include('admin.pages.plans._partials.form')
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning">Editar</button>
                    </div>

                </form>
        </div>
    </div>

@stop

