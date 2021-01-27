<div class="table-responsive" style="overflow-x: visible; overflow-y: visible;">

    <table id="tabela-especialidades" class="mt-5 table table-striped">
        <thead>
            <tr>
                @foreach($headers as $header)
                    <th class="text-center" scope="col">{{ strtoupper($header) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr data-id="{{ $item['id'] }}">
                    <td class="text-center">{{ $item['nome'] }}</td>
                    <td class="text-center d-flex align-items-center justify-content-center">
                        <button class="btn" onclick="visualizar({{ $item['id'] }});">
                            <i class="fas fa-info-circle"></i>
                        </button>
                        <button class="btn" onclick="editar({{ $item['id'] }});">
                            <i class="fas fa-pen"></i>
                        </button>
                        <button class="btn" onclick="remover({{ $item['id'] }}, '{{ $item['nome'] }}');">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>