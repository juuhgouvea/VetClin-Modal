@extends('default', ['titulo' => 'Especialidades'])

@section('content')
    <div class="row w-100 text-center d-flex align-items-center justify-content-center">
        <div class="col-sm-5">
            <div class="form-group">
                <button class="btn btn-lg btn-primary w-100 btn-block" onclick="criar();">
                    <b>Cadastrar Nova Especialidade</b>
                </button>
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
        
    <x-tablelistEsp :headers="['nome', 'eventos']" :data="$especialidades"/>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalEsp">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formEsp">
                    <div class="modal-header">
                        <h5 class="modal-title"><b>Nova Especialidade</b></h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="id">
                        <div class="row">
                            <div class="col-sm-12">
                                <label><b>Nome</b></label>
                                <input type="text" class="form-control" name="nome" id="nome" required>
                            </div>
                        </div>

                        <div class="row" style="margin-top:10px">
                            <div class="col-sm-12">
                                <label><b>Descrição</b></label>
                                <textarea class="form-control" name="descricao" id="descricao" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalInfo">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><b>Informações da Especialidade</b></h5>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>    

    <div class="modal fade" tabindex="-1" role="dialog" id="modalRemove">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <input type="hidden" id="id-remove" class="form-control">
                <div class="modal-header">
                    <h5 class="modal-title"><b>Remover Especialidade</b></h5>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" onclick="destroy()">Remover</button>
                    <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>    
@endsection

@section('script')
    <script type="text/javascript">

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : " {{ csrf_token() }}"
            }
        });

        function criar(){
            $('#modalEsp').modal().find('.modal-title').html('<b>Cadastrar Especialidade</b>');
            $('#id').val('');
            $('#nome').val('');
            $('#descricao').val('');
            $('#modalEsp').modal('show');
        }

        function visualizar(id){
            $("#modalInfo").modal().find('.modal-body').html("");

            $.getJSON('/api/especialidades/'+id, function(dados){
                $("#modalInfo").modal().find('.modal-body').append("<b>ID: <b>" + dados.id + "<br><br>");
                $("#modalInfo").modal().find('.modal-body').append("<b>Nome: <b>" + dados.nome + "<br><br>");
                $("#modalInfo").modal().find('.modal-body').append("<b>Descrição: <b>" + dados.descricao + "<br><br>");
            })
        }

        function editar(id){
            $('#modalEsp').modal().find('.modal-title').html('<b>Alterar Especialidade</b>');

            $.getJSON('/api/especialidades/'+id, function(dados){
                $("#id").val(dados.id);
                $("#nome").val(dados.nome);
                $("#descricao").val(dados.descricao);
                $('#modalEsp').modal('show');
            });     
            
        }

        function remover(id, nome){
            $('#modalRemove').modal().find('.modal-body').html("");
            $('#modalRemove').modal().find('.modal-body').append("Deseja remover a especialidade '" + nome + "'?");
            $("#id-remove").val(id);
            $('#modalRemove').modal('show');
        }


        $('#formEsp').submit( function(event) {

            event.preventDefault();

            if($('#id').val() != ''){
                update( $("#id").val() );
            }
            else{
                insert();
            }

            $('#modalEsp').modal('hide');
        })

        function insert(){
            especialidade = {
                nome: $('#nome').val(),
                descricao: $('#descricao').val(),
            };

            $.post('/api/especialidades', especialidade, function(dados){
                const novaEsp = JSON.parse(dados);
                renderizarLinhaTabelaEsp(novaEsp);
            })
        }

        function update(id) {
            const especialidade = {
                nome: $("#nome").val(),
                descricao: $("#descricao").val(),
            }


            $.ajax({
                type: "PUT",
                url: "/api/especialidades/" + id,
                context: this,
                dataType: 'json',
                data: { ...especialidade },
                success: function(dados) {
                    const colunaNome = $(`tr[data-id="${id}"] td:first-child`);
                    colunaNome.text(dados.nome);
                },

                error: function(error) {
                    alert('Erro no Update');
                }
            })
        }

        function destroy() {
            const id = $('#id-remove').val();
            
            $.ajax({
                type: "DELETE",
                url: `api/especialidades/${id}`,
                context: this,
                dataType: 'json',
                success: function(dados) {
                    console.log(dados);
                    const tr = $(`tr[data-id="${id}"]`);
                    tr.remove();
                    $('#modalRemove').modal('hide');
                },
                error: function(error) {
                    alert('Não foi possível excluir a especialidade.');
                }
            });
        }

        function renderizarLinhaTabelaEsp(especialidade) {
            const html = `
                <tr data-id="${especialidade.id}">
                    <td class="text-center">${especialidade.nome}</td>
                    <td class="text-center d-flex align-items-center justify-content-center">
                        <button class="btn" onclick="visualizar(${especialidade.id})">
                            <i class="fas fa-info-circle"></i>
                        </button>
                        <button class="btn" onclick="editar(${especialidade.id})">
                            <i class="fas fa-pen"></i>
                        </button>
                        <button class="btn" onclick="remover(${especialidade.id}, ${`'${especialidade.nome}'`});">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;

            $('#tabela-especialidades tbody').append(html);
        }

    </script>
    
@endsection