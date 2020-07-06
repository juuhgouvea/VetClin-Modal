@extends('default', ['titulo' => 'Visualizar Especialidade', 'iconClass' => 'fas fa-eye'])

@section('content')
    <a class="btn btn-outline-primary font-weight-bold" href="{{ route('especialidades.index') }}"><i class="fas fa-arrow-left"></i> Voltar</a>
    <h1 class="text-center text-success">{{$especialidade['nome']}}</h1>
    <h1 class="text-center text-success">{{$especialidade['descricao']}}</h1>
@endsection