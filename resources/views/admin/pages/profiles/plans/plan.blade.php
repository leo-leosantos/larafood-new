@extends('adminlte::page')

@section('title', "Planos do perfil {$profile->name}")

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}" >Perfis</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.plans', $profile->id) }}" class="active">Permissões</a></li>

    </ol>
    <h1>Planos do Perfil: <strong> {{ $profile->name }} </strong> -

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
                    @foreach ($plans as $plan)
                        <tr>
                            <td> {{ $plan->id }}</td>
                            <td> {{ $plan->name }}</td>
                            <td style="width: 10px;">
                                <a href="{{ route('plans.profile.detach', [$plan->id,$profile->id ]) }}" class="btn btn-danger">DESVINCULAR</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">

            @if (isset($filters))
                {!! $plans->appends($filters)->links() !!}
                @else
                {!! $plans->links() !!}
            @endif
        </div>
    </div>


@stop
