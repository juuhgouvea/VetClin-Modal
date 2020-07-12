@extends('default', ['titulo' => 'Editar Especialidade', 'iconClass' => 'fas fa-edit'])

@section('content')
    <form action = "{{ route('especialidades.update', $dados['id'])}}" method = "POST">
        @csrf
        <div class="form-group">
            <label class="font-weight-bold" for="nome">Nome</label>
            <input type="text" id="nome" name="nome" value="{{ old('nome') ? old('nome') : $dados['nome'] }}" class="form-control {{ $errors->has('nome') ? 'is-invalid' : ''}}">
            @if($errors->has('nome'))
                <div class="invalid-feedback">
                    {{ $errors->first('nome')}}
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="font-weight-bold" for="descricao">Descrição</label>
                    <textarea  class="form-control {{ $errors->has('descricao') ? 'is-invalid' : ''}}" id="descricao" rows="5" name="descricao">{{ old('descricao') ? old('descricao') : $dados['descricao'] }}</textarea>
                    @if($errors->has('descricao'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descricao')}}
                        </div>
                    @endif
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

        @method('PUT')
    </form>
@endsection