@extends('adminlte::page')

@section('title', "Perfils disponíveis para o  Plano {$plan->name}")

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item "><a href="{{ route('plans.profiles', $plan->id) }}">Perfis</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.profiles.available', $plan->id) }}" class="active">Disponíveis</a></li>

    </ol>
    <h1>Perfils disponíveis para o  Plano: <strong> {{ $plan->name }} </strong> </h1>

@stop

@section('content')


    <div class="card">
        <div class="card-header">

            <form action="{{ route('plans.profiles.available', $plan->id) }}" method="post" class="form form-inline">
                @csrf
                <div class="form-group">
                    <input type="text" name="filter" placeholder="Pesquisar" class="form-control"
                        value="{{ $filters['filter'] ?? '' }}">
                </div>
                <button type="submit" class=" btn btn-dark">Filtrar</button>

            </form>

        </div>
        <div class="card-body">

            <table class="table table-condensed">
                <thead>
                    <th>id</th>
                    <th width="50px">#</th>
                    <th>Nome</th>
                </thead>
                <tbody>
                    <form action="{{ route('plans.profiles.attach', $plan->id) }}" method="POST">
                        @csrf

                        @foreach ($profiles as $profile)
                            <tr>
                                <td> {{ $profile->id }}</td>

                                <td>
                                    <input type="checkbox" name="profiles[]" value="{{ $profile->id }}"
                                        id="">
                                </td>

                                <td> {{ $profile->name }}</td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="500">

                                @include('admin.includes.alerts')
                                    <button type="submit" class=" btn btn-success">Vincular</button>
                            </td>
                        </tr>
                    </form>
                </tbody>

            </table>
        </div>

        <div class="card-footer">

            @if (isset($filters))
                {!! $profiles->appends($filters)->links() !!}

                @else
                {!! $profiles->links() !!}
            @endif
        </div>
    </div>


@stop
