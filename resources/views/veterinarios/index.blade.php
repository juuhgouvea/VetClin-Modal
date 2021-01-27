@extends('default', ['titulo' => 'Veterinários'])

@section('content')
    <div class="row w-100 text-center d-flex align-items-center justify-content-center">
        <div class="col-sm-5">
            <div class="form-group">
                <button class="btn btn-lg btn-primary w-100 btn-block" onclick="criar()">
                    <b>Cadastrar Novo Veterinário</b>
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
        
    <x-tablelistVet :headers="['nome', 'eventos']" :data="$veterinarios"/>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalVet">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formVet">
                    <div class="modal-header">
                        <h5 class="modal-title"><b>Novo Veterinário</b></h5>
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
                                <label><b>CRMV</b></label>
                                <input type="text" class="form-control" name="crmv" id="crmv" required>
                            </div>
                        </div>

                        <div class="row" style="margin-top:10px">
                            <div class="col-sm-12">
                                <label for="especialidade"><b>Especialidade</b></label>
                                <select class="form-control" name="especialidades" id="especialidades" required>
                                    @foreach ( $especialidades ?? [] as $esp)
                                        <option value="{{ $esp['id'] }}"><p> {{ $esp['nome']}} </p></option>
                                    @endforeach
                                </select>
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
                    <h5 class="modal-title"><b>Informações do Veterinário</b></h5>
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
                    <h5 class="modal-title"><b>Remover Veterinário</b></h5>
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
            $('#especialidades option').removeAttr('selected');
            $('#modalVet').modal().find('.modal-title').html('<b>Cadastrar Veterinário</b>');
            $('#id').val('');
            $('#nome').val('');
            $('#crmv').val('');
            $('#modalVet').modal('show');
        }

        function visualizar(id){
            $("#modalInfo").modal().find('.modal-body').html("");

            $.getJSON('/api/veterinarios/'+id, function(dados){
                $("#modalInfo").modal().find('.modal-body').append("<b>ID: <b>" + dados.id + "<br><br>");
                $("#modalInfo").modal().find('.modal-body').append("<b>Nome: <b>" + dados.nome + "<br><br>");
                $("#modalInfo").modal().find('.modal-body').append("<b>CRMV: <b>" + dados.crmv + "<br><br>");
                $("#modalInfo").modal().find('.modal-body').append("<b>Especialidade: <b>" + dados.especialidade.nome + "<br><br>");
            })
        }

        function editar(id){
            $('#modalVet').modal().find('.modal-title').html('<b>Alterar Veterinário</b>');
            $('#especialidades option[selected]').removeAttr('selected');
            $("#id").val('');
            $("#nome").val('');
            $("#crmv").val('');
            $('#especialidades').val('');

            $.getJSON('/api/veterinarios/'+id, function(dados){
                $(`#especialidades option[value="${dados.especialidade_id}"]`).attr('selected');
                $("#id").val(dados.id);
                $("#nome").val(dados.nome);
                $("#crmv").val(dados.crmv);
                $('#especialidades').val(dados.especialidade_id);
                $('#modalVet').modal('show');
            });     
            
        }

        function remover(id, nome){
            $('#modalRemove').modal().find('.modal-body').html("");
            $('#modalRemove').modal().find('.modal-body').append("Deseja remover o veterinário '" + nome + "'?");
            $("#id-remove").val(id);
            $('#modalRemove').modal('show');
        }


        $('#formVet').submit( function(event) {

            event.preventDefault();

            if($('#id').val() != ''){
                update( $("#id").val() );
            }
            else{
                insert();
            }

            $('#modalVet').modal('hide');
        })

        function insert(){
            veterinario = {
                nome: $('#nome').val(),
                crmv: $('#crmv').val(),
                especialidades: $('#especialidades').val(),
            };

            $.post('/api/veterinarios', veterinario, function(dados){
                novoVet = JSON.parse(dados);
                renderizarLinhaTabelaVet(novoVet);
            })
        }

        function update(id){
            const veterinario = {
                nome: $("#nome").val(),
                crmv: $("#crmv").val(),
                especialidades: $("#especialidades").val(),
            }


            $.ajax({
                type: "PUT",
                url: "/api/veterinarios/" + id,
                context: this,
                dataType: 'json',
                data: { ...veterinario },
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
                url: `api/veterinarios/${id}`,
                context: this,
                dataType: 'json',
                success: function(dados) {
                    console.log(dados);
                    const tr = $(`tr[data-id="${id}"]`);
                    tr.remove();
                    $('#modalRemove').modal('hide');
                },
                error: function(error) {
                    alert('Não foi possível excluir o veterinário.');
                }
            });
        }

        function renderizarLinhaTabelaVet(veterinario) {
            const html = `
                <tr data-id="${veterinario.id}">
                    <td class="text-center">${veterinario.nome}</td>
                    <td class="text-center d-flex align-items-center justify-content-center">
                        <button class="btn" onclick="visualizar(${veterinario.id})">
                            <i class="fas fa-info-circle"></i>
                        </button>
                        <button class="btn" onclick="editar(${veterinario.id})">
                            <i class="fas fa-pen"></i>
                        </button>
                        <button class="btn" onclick="remover(${veterinario.id}, ${`'${veterinario.nome}'`});">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;

            $('#tabela tbody').append(html);
        }

    </script>
    
@endsection