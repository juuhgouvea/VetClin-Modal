@extends('default', ['titulo' => 'Clientes', 'iconClass' => 'fas fa-user'])

@section('content')
<div class="row w-100 text-center d-flex align-items-center justify-content-center">
    <div class="col-sm-5">
        <div class="form-group">
            <a class="btn btn-lg btn-primary w-100" href="{{ route('clientes.create')}}">Cadastrar Novo Cliente</a>
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
        
        <x-tablelistCliente :headers="['nome', 'eventos']" :data="$clientes" />
        
@endsection