@extends('default', ['titulo' => 'Editar Cliente', 'iconClass' => 'fas fa-edit'])

@section('content')
    <form action = "{{ route('clientes.update', $dados['id'])}}" method = "POST">
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
            <div class="col-sm-7">
                <div class="form-group">
                    <label class="font-weight-bold" for="email">E-mail</label>
                    <input type="text" id="email" name="email" value="{{ old('email') ? old('email') : $dados['email'] }}" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}">
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email')}}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-sm-5">
                <div class="form-group">
                    <label class="font-weight-bold" for="telefone">Telefone</label>
                    <input type="text" id="telefone" name="telefone" value="{{ old('telefone') ? old('telefone') : $dados['telefone'] }}" class="form-control {{ $errors->has('telefone') ? 'is-invalid' : ''}}">
                    @if($errors->has('telefone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('telefone')}}
                        </div>
                    @endif
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

        @method('PUT')
    </form>
@endsection
