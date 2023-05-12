@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.index') }}" >Planos</a></li>

    </ol>
    <h1>Planos -  <a href="{{ route('plans.create') }}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD </a> </h1>


@stop

@section('content')


    <div class="card">
        <div class="card-header">

            <form action="{{ route('plans.search') }}" method="post" class="form form-inline">
                @csrf
                    <div class="form-group">
                        <input type="text" name="filter" placeholder="Pesquisar" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                    </div>
                <button type="submit" class=" btn btn-dark">Filtrar</button>

            </form>

        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <th>#</th>

                    <th>Nome</th>
                    <th>Preço</th>
                    <th width= "290" >Ações</th>

                </thead>
                @foreach ( $plans as $plan )
                    <tbody>
                        <td> {{ $plan->id }}</td>
                        <td> {{ $plan->name }}</td>
                        <td>  R$ {{ number_format($plan->price,2,',', '.' )  }}</td>
                        <td style="width: 10px;">
                            <a href="{{ route('details.plan.index', $plan->url) }}" class="btn btn-primary">Detalhes</a>
                            <a href="{{ route('plans.edit', $plan->url) }}" class="btn btn-warning">Editar</a>

                            <a href="{{ route('plans.show', $plan->url) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('plans.profiles', $plan->id ) }}" class="btn btn-secondary"><i class="fas fa-address-book"></i></a>

                        </td>
                    </tbody>
                @endforeach

            </table>
        </div>

        <div class="card-footer">

            @if (isset($filters))

                {!! $plans->appends($filters)->links() !!}

                else
                {!! $plans->links() !!}

            @endif
        </div>
    </div>


@stop

