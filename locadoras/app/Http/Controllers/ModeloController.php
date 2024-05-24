<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use App\Repositories\RepositoryModelo;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $modelo;

    public function __construct(Modelo $modelo)
    {
        $this->modelo = $modelo;
    }
    public function index()
    {
        $repositoryModelo = new RepositoryModelo($this->modelo);
        $modelos = $repositoryModelo->getAll();
        if ($modelos->count() <= 0) {
            return response()->json(['erro' => 'não há nenhum modelo'], 404);
        }

        return response()->json($modelos, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreModeloRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $repositoryModelo = new RepositoryModelo($this->modelo);
        $request->validate($this->modelo->rules(), $this->modelo->feedback());
        
        $modelo = $repositoryModelo->create($request);

        return response()->json($modelo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $repositoryModelo = new RepositoryModelo($this->modelo);
        $modelo = $repositoryModelo->get($id);

        if ($modelo == null) {
            return response()->json(['erro' => 'Não foi possivel encontrar o modelo'], 404);
        }

        return response()->json($modelo, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function edit(Modelo $modelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateModeloRequest  $request
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $repositoryModelo = new RepositoryModelo($this->modelo);
        $modelo = $repositoryModelo->edit($id,$request);

        if ($modelo == null) {
            return response()->json(['erro' => 'O modelo não foi encontrado']);
        }
        return response()->json($modelo, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $repositoryModelo = new RepositoryModelo($this->modelo);

        $modelo = $repositoryModelo->delete($id);

        if ($modelo == null) {
            return response()->json(['erro' => 'O modelo não foi encontrado'], 200);
        }else if($modelo == true){
            return response()->json(['info' => 'Tem carros cadastrado neste modelo']);
        }

        return response()->json(['Sucesso' => 'Modelo deletado'],200);
    }
}
