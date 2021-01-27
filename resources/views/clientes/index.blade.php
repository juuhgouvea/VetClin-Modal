@extends('default', ['titulo' => 'Clientes', 'iconClass' => 'fas fa-user'])

@section('content')
    <div class="row w-100 text-center d-flex align-items-center justify-content-center">
        <div class="col-sm-5">
            <div class="form-group">
                <button class="btn btn-lg btn-primary w-100 btn-block" onclick="criar();">
                    <b>Cadastrar Novo Cliente</b>
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
        
    <x-tablelistCliente :headers="['nome', 'eventos']" :data="$clientes"/>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalCliente">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formCliente">
                    <div class="modal-header">
                        <h5 class="modal-title"><b>Novo Cliente</b></h5>
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
                                <label><b>E-mail</b></label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                        </div>

                        <div class="row" style="margin-top:10px">
                            <div class="col-sm-12">
                                <label><b>Telefone</b></label>
                                <input type="text" class="form-control" name="telefone" id="telefone" required>
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
                    <h5 class="modal-title"><b>Informações do Cliente</b></h5>
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
                    <h5 class="modal-title"><b>Remover Cliente</b></h5>
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
            $('#modalCliente').modal().find('.modal-title').html('<b>Cadastrar Cliente</b>');
            $('#id').val('');
            $('#nome').val('');
            $('#email').val('');
            $('#telefone').val('');
            $('#modalCliente').modal('show');
        }

        function visualizar(id){
            $("#modalInfo").modal().find('.modal-body').html("");

            $.getJSON('/api/clientes/'+id, function(dados){
                $("#modalInfo").modal().find('.modal-body').append("<b>ID: <b>" + dados.id + "<br><br>");
                $("#modalInfo").modal().find('.modal-body').append("<b>Nome: <b>" + dados.nome + "<br><br>");
                $("#modalInfo").modal().find('.modal-body').append("<b>E-mail: <b>" + dados.email + "<br><br>");
                $("#modalInfo").modal().find('.modal-body').append("<b>Telefone: <b>" + dados.telefone + "<br><br>");
            })
        }

        function editar(id){
            $('#modalCliente').modal().find('.modal-title').html('<b>Alterar Cliente</b>');

            $.getJSON('/api/clientes/'+id, function(dados){
                $("#id").val(dados.id);
                $("#nome").val(dados.nome);
                $("#email").val(dados.email);
                $("#telefone").val(dados.telefone);
                $('#modalCliente').modal('show');
            });     
            
        }

        function remover(id, nome){
            $('#modalRemove').modal().find('.modal-body').html("");
            $('#modalRemove').modal().find('.modal-body').append("Deseja remover o cliente '" + nome + "'?");
            $("#id-remove").val(id);
            $('#modalRemove').modal('show');
        }


        $('#formCliente').submit( function(event) {

            event.preventDefault();

            if($('#id').val() != ''){
                update( $("#id").val() );
            }
            else{
                insert();
            }

            $('#modalCliente').modal('hide');
        })

        function insert(){
            cliente = {
                nome: $('#nome').val(),
                email: $('#email').val(),
                telefone: $('#telefone').val(),
            };

            $.post('/api/clientes', cliente, function(dados){
                novoCliente = JSON.parse(dados);
                renderizarLinhaTabelaCliente(novoCliente);
            })
        }

        function update(id){
            const cliente = {
                nome: $("#nome").val(),
                email: $("#email").val(),
                telefone: $("#telefone").val(),
            }


            $.ajax({
                type: "PUT",
                url: "/api/clientes/" + id,
                context: this,
                dataType: 'json',
                data: { ...cliente },
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
                url: `api/clientes/${id}`,
                context: this,
                dataType: 'json',
                success: function(dados) {
                    console.log(dados);
                    const tr = $(`tr[data-id="${id}"]`);
                    tr.remove();
                    $('#modalRemove').modal('hide');
                },
                error: function(error) {
                    alert('Não foi possível excluir o cliente.');
                }
            });
        }

        function renderizarLinhaTabelaCliente(cliente) {
            const html = `
                <tr data-id="${cliente.id}">
                    <td class="text-center">${cliente.nome}</td>
                    <td class="text-center d-flex align-items-center justify-content-center">
                        <button class="btn" onclick="visualizar(${cliente.id})">
                            <i class="fas fa-info-circle"></i>
                        </button>
                        <button class="btn" onclick="editar(${cliente.id})">
                            <i class="fas fa-pen"></i>
                        </button>
                        <button class="btn" onclick="remover(${cliente.id}, ${`'${cliente.nome}'`});">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;

            $('#tabela tbody').append(html);
        }

    </script>
    
@endsection