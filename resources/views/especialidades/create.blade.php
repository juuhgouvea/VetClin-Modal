@extends('default', ['titulo' => 'Cadastrar Especialidade'])

@section('content')
    <form action="{{ route('especialidades.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label class="font-weight-bold" for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="">
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="font-weight-bold" for="descricao">Descrição</label>
                    <textarea  class="form-control" id="descricao" name="descricao" rows="5" value=""></textarea>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-4">
                <a  href="{{ route('especialidades.index') }}" class="btn btn-danger btn-lg w-100">Cancelar / Voltar</a>
            </div>
            <div class="col-sm-8">
                <button type="submit" class="btn btn-primary btn-lg w-100">Confirmar / Salvar</button>
            </div>
        </div>
    </form>
@endsection