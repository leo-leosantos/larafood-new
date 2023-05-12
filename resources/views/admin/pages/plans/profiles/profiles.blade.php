@extends('adminlte::page')

@section('title', "Perfils do plano {$plan->name}")

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.profiles', $plan->id) }}" class="active">Planos</a></li>

    </ol>
    <h1>Perfils do plano: <strong> {{ $plan->name }} </strong> -
        <a href="{{ route('plans.profiles.available', $plan->id) }}" class="btn btn-dark"><i
                class="fas fa-plus-square"></i> ADD NOVO PERFIL </a>
    </h1>


@stop

@section('content')


    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')
            <table class="table table-condensed">
                <thead>
                    <th>#</th>
                    <th>Nome</th>
                    <th width="50">Ações</th>
                </thead>
                <tbody>
                    @foreach ($profiles as $profile)
                        <tr>
                            <td> {{ $profile->id }}</td>
                            <td> {{ $profile->name }}</td>
                            <td style="width: 10px;">
                                <a href="{{ route('plans.profiles.detach', [$plan->id,$profile->id ]) }}" class="btn btn-danger">DESVINCULAR</a>
                            </td>
                        </tr>
                    @endforeach
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
