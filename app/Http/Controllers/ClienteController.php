<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente as Cliente;

class ClienteController extends Controller
{

    // public $clientes = [[
    //     'id' => 1,
    //     'nome' => 'Julia Gouvêa',
    //     'email' => 'juliagouvea@gmail.com',
    //     'telefone' => '55555555'
    // ]];

    // public function __construct(){

    //     $aux = session('clientes');

    //     if(!isset($aux)){
    //         session(['clientes' => $this->clientes]);
    //     }
    // }

    public function index(Request $request){
        // $clientes = session('clientes');
        // /** index -> ['clientes' => [['nome']]] */
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $aux = session('clientes');
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
        //     'telefone' => $request->telefone,
        //     'email' => $request->email
        // ];

        $regras = [
            'nome' => 'required|max:100|min:2',
            'telefone' => 'required|max:13|min:11',
            'email' => 'required|unique:clientes,email'
        ];
        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres.",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres.",
            "unique" => "[:attribute] já existente."
        ];

        $request->validate($regras, $msgs);

        $cliente = Cliente::create([
            'nome' => $request->nome,
            'telefone' => $request->telefone,
            'email' => $request->email
        ]);

        // array_push($aux, $novo);
        // session(['clientes' => $aux]);



        return json_encode($cliente);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        // $aux = session('clientes');
        // $indice = array_search($id, array_column($aux, 'id'));
        // if($indice === false) return view('404');
        // $chave = array_keys($aux)[$indice];
        // $cliente = $aux[$chave];
        $cliente = Cliente::find($id);

        if(isset($cliente)){
            return json_encode($cliente);
        }
        return response("Cliente não encontrado", 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $aux = session('clientes');
        // $indice = array_search($id, array_column($aux, 'id'));
        // if($indice === false) return view('404');
        // $dados = $aux[$indice];

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
        $cliente = Cliente::find($id);

        $cliente->fill([
            'nome' => $request->nome,
            'telefone' => $request->telefone,
            'email' => $request->email
        ]);

        $regras = [
            'nome' => 'required|max:100|min:2',
            'telefone' => 'required|max:13|min:11',
            'email' => "required|unique:clientes,email,{$id}"
        ];
        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres.",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres.",
            "unique" => "[:attribute] já existente."
        ];

        $request->validate($regras, $msgs);

        $cliente->save();
        // $alterado = [
            // 'nome' => $request->nome,
            // 'telefone' => $request->telefone,
            // 'email' => $request->email
        // ];

        // $aux = session('clientes');
        // $indice = array_search($id, array_column($aux, 'id'));

        // $aux[$indice] = $alterado;
        // session(['clientes' => $aux]);

        return response()->json($cliente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $aux = session('clientes');
        // $indice = array_search($id, array_column($aux, 'id'));

        // unset($aux[$indice]);
        // session(['clientes' => $aux]);

        $cliente = Cliente::find($id);

        $cliente->delete();

        return response()->json([], 201);
    }
}
