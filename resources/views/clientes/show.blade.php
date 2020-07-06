@extends('default', ['titulo' => 'Visualizar Cliente', 'iconClass' => 'fas fa-eye'])

@section('content')
    <a class="btn btn-outline-primary font-weight-bold" href="{{ route('clientes.index') }}"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1 class="text-center text-success">{{$cliente['nome']}}</h1>
    <h1 class="text-center text-success">{{$cliente['email']}}</h1>
    <h1 class="text-center text-success">{{$cliente['telefone']}}</h1>
@endsection