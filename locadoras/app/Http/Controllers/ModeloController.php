<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $modelo;

    public function __construct(Modelo $modelo){
        $this->modelo = $modelo;
    }
    public function index()
    {
        $modelos = $this->modelo->all();

        if ($modelos->count() <= 0){
            return response()->json(['erro' => 'não há nenhum modelo'],404);
        }

        return response()->json($modelos,200);
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

        
        $modelo = $this->modelo->create($request->all());
        
        return response()->json($modelo,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modelo = $this->modelo->find($id);

        if($modelo == null){
            return response()->json(['erro' => 'Não foi possivel encontrar o modelo'],404);
        }

        return response()->json($modelo,200);
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
        $modelo = $this->modelo->find($id);

        if($modelo == null){
            return response()->json(['erro' => 'O modelo não foi encontrado']);
        }

        $modelo->update($request->all());
        return response()->json($modelo,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modelo = $this->modelo->find($id);

        if($modelo == null){
            return response()->json(['erro' => 'O modelo não foi encontrado'],200);
        }
    }
}
