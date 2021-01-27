<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Veterinario as Veterinario;
use App\Especialidade as Especialidade;

class VeterinarioController extends Controller
{
    // public $veterinario = [[
    //     'id' =>  1,
    //     'nome' => 'Letícia Hermont',
    //     'crmv' => 'MG',
    //     'especialidade_id' => '1'
    // ]];

    // public function __construct(){

    //     $aux = session('veterinarios');

    //     if(!isset($aux)){
    //         session(['veterinarios' => $this->veterinario]);
    //     }
    // }

    public function index(Request $request)
    {
        // $veterinarios = session('veterinarios');
        $especialidades = Especialidade::all();
        $veterinarios = Veterinario::all();
        return view('veterinarios.index', compact('veterinarios', 'especialidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $especialidades = session('especialidades');

        // $especialidades = Especialidade::all();
        // return view('veterinarios.create')->with('especialidades', $especialidades);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $aux = session('veterinarios');
        // $ids = array_column($aux, 'id');

        // if(count($ids) > 0){
        //     $new_id = max($ids) + 1;
        // }
        // else{
        //     $new_id = 1;
        // }

        // $novo = [
        //     'id' => $new_id,
        //     'nome' => $request->nome,
        //     'crmv' => $request->crmv,
        //     'especialidade_id' => $request->especialidades
        // ];
        
        
        
        // array_push($aux, $novo);
        // session(['veterinarios' => $aux]);
        
        $regras = [
            'nome' => 'required|max:30|min:2',
            'crmv' => 'required|max:6|min:6',
        ];
        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres.",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres.",
        ];
        
        $request->validate($regras, $msgs);
        
        $veterinario = Veterinario::create([
            'nome' => $request->nome,
            'crmv' => $request->crmv,
            'especialidade_id' => $request->especialidades
        ]);
        
        return json_encode($veterinario);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $aux = session('veterinarios');
        // $indice = array_search($id, array_column($aux, 'id'));
        // if($indice === false) return view('404');
        // $chave = array_keys($aux)[$indice];
        // $veterinario = $aux[$chave];

        // $especialidades = session('especialidades');
        // $especialidadeIndice = array_search($veterinario['especialidade_id'], array_column($especialidades, 'id'));
        // $especialidadeChave = array_keys($especialidades)[$especialidadeIndice];
        // $especialidade = $especialidades[$especialidadeChave];

        // $veterinario['especialidade'] = $especialidade['nome'];
        $veterinario = Veterinario::with('especialidade')->find($id);

        if(isset($veterinario)){
            return json_encode($veterinario);
        }
        return response("Veterinario não encontrado", 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $aux = session('veterinarios');
        // $indice = array_search($id, array_column($aux, 'id'));
        // if($indice === false) return view('404');
        // $dados = $aux[$indice];

        // $dados = Veterinario::find($id);
        // $especialidades = Especialidade::all();

        // return view('veterinarios.edit', ['dados' => $dados, 'especialidades' => $especialidades]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $alterado = [
        //     'id' => $id,
        //     'nome' => $request->nome,
        //     'crmv' => $request->crmv,
        //     'especialidade_id' => $request->especialidades
        // ];

        // $aux = session('veterinarios');
        // $indice = array_search($id, array_column($aux, 'id'));

        // $aux[$indice] = $alterado;
        // session(['veterinarios' => $aux]);
        $veterinario = Veterinario::find($id);
        $veterinario->fill([
            'nome' => $request->nome,
            'crmv' => $request->crmv,
            'especialidade_id' => $request->especialidades
        ]);

        $regras = [
            'nome' => 'required|max:30|min:2',
            'crmv' => 'required|max:6|min:6',
        ];
        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres.",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres.",
        ];
        
        $request->validate($regras, $msgs);
        
        $veterinario->save();

        return response()->json($veterinario);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $aux = session('veterinarios');
        // $indice = array_search($id, array_column($aux, 'id'));

        // unset($aux[$indice]);
        // session(['veterinarios' => $aux]);
        $veterinario = Veterinario::find($id);
        $veterinario->delete();

        return response()->json([], 201);
    }
}
