@extends('default', ['titulo' => 'Visualizar Veterinário'])

@section('content')
    <a class="btn btn-outline-primary font-weight-bold" href="{{ route('veterinarios.index') }}"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1 class="text-center text-success">{{$veterinario['nome']}}</h1>
    <h1 class="text-center text-success">{{$veterinario['crmv']}}</h1>
    <h1 class="text-center text-success">{{$veterinario->especialidade->nome}}</h1>

@endsection