<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Especialidade as Especialidade;

class EspecialidadeController extends Controller
{
 
    // public $especialidades = [[
    //     'id' => 1,
    //     'nome' => 'Cardiologista',
    //     'descricao' => 'cardio'
    // ]];

    // public function __construct(){

    //     $aux = session('especialidades');

    //     if(!isset($aux)){
    //         session(['especialidades' => $this->especialidades]);
    //     }
    // }

    public function index(Request $request){
        // $especialidades = session('especialidades');
        $especialidades = Especialidade::all();
        return view('especialidades.index', compact('especialidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('especialidades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $aux = session('especialidades');
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
        //     'descricao' => $request->descricao,
        // ];

        Especialidade::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
        ]);

        // array_push($aux, $novo);
        // session(['especialidades' => $aux]);

        return redirect()->route('especialidades.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $especialidade = Especialidade::find($id);
        // $aux = session('especialidades');
        // $indice = array_search($id, array_column($aux, 'id'));
        // if($indice === false) return view('404');
        // $chave = array_keys($aux)[$indice];
        // $especialidade = $aux[$chave];

        return view('especialidades.show')->with('especialidade', $especialidade);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dados = Especialidade::find($id);

        // $aux = session('especialidades');
        // $indice = array_search($id, array_column($aux, 'id'));
        // if($indice === false) return view('404');
        // $dados = $aux[$indice];

        return view('especialidades.edit', compact('dados'));
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
            //     'descricao' => $request->descricao,
            // ];
            
        //     $aux = session('especialidades');
        //     $indice = array_search($id, array_column($aux, 'id'));
            
        //     $aux[$indice] = $alterado;
        // session(['especialidades' => $aux]);

        $especialidade = Especialidade::find($id);
        $especialidade->fill([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
        ]);

        $especialidade->save();
        
        return redirect()->route('especialidades.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $aux = session('especialidades');
        // $indice = array_search($id, array_column($aux, 'id'));

        // unset($aux[$indice]);
        // session(['especialidades' => $aux]);
        $especialidade = Especialidade::find($id);
        $especialidade->delete();

        return redirect()->route('especialidades.index');
    }
}