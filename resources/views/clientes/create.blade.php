@extends('default', ['titulo' => 'Cadastrar Cliente'])

@section('content')
    <form action="{{ route('clientes.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label class="font-weight-bold" for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="">
        </div>

        <div class="row">
            <div class="col-sm-7">
                <div class="form-group">
                    <label class="font-weight-bold" for="email">E-mail</label>
                    <input type="text" class="form-control" id="email" name="email" value="">
                </div>
            </div>
            <div class="col-sm-5">
                <div class="form-group">
                    <label class="font-weight-bold" for="telefone">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" value="">
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-4">
                <a  href="{{ route('clientes.index') }}" class="btn btn-danger btn-lg w-100">Cancelar / Voltar</a>
            </div>
            <div class="col-sm-8">
                <button type="submit" class="btn btn-primary btn-lg w-100">Confirmar / Salvar</button>
            </div>
        </div>
    </form>
@endsection