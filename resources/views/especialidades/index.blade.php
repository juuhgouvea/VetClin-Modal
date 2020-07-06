@extends('default', ['titulo' => 'Especialidades'])

@section('content')
<div class="row w-100 text-center d-flex align-items-center justify-content-center">
    <div class="col-sm-5">
        <div class="form-group">
            <a class="btn btn-lg btn-primary w-100" href="{{ route('especialidades.create')}}">Cadastrar Nova Especialidade</a>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Buscar">
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <a class="btn"><i class="fas fa-search"></i></a>
        </div>
    </div>
</div>
        
        <x-tablelistEsp :headers="['nome', 'eventos']" :data="$especialidades" />
        
@endsection