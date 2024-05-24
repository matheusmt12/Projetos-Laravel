<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Repositories\RepositoryMarca;
use Illuminate\Http\Request;


class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $marca;
    public function __construct(Marca $marca)
    {
        $this->marca = $marca;
    }

    public function index()
    {

        $marcaRepository = new RepositoryMarca($this->marca);

        $marcas = $marcaRepository->getAll();
        if($marcas->count() <= 0){
            return response()->json(['erro' => 'não há marcas'], 404);
        }
        return response()->json($marcas,200);
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
     * @param  \App\Http\Requests\StoreMarcaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $marcaRepository = new RepositoryMarca($this->marca);
        $request->validate($this->marca->rules(), $this->marca->feedback());
        
        
        $marca = $marcaRepository->create($request); 
        //$this->marca->create(['name' => $request->name, 'imagem' => $request->imagem]);

        return response()->json($marca,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $marcaRepository = new RepositoryMarca($this->marca);
        $marca = $marcaRepository->get($id);
        if ($marca == null){
            return response()->json(['erro' => 'Marca não encontrada'], 404);
        }

        return response()->json( $marca, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMarcaRequest  $request
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $marcaRepository = new RepositoryMarca($this->marca);
        $marca = $marcaRepository->edit($id, $request);

        if($marca == null){
            return response()->json(['erro'=> 'Marca não encontrada']);
        }

        return response()->json($marca,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $marcaRepository = new RepositoryMarca($this->marca);
        $marca = $marcaRepository->delete($id);
        if($marca == null){
            return response()->json(['erro' => 'A marca não foi encontrada'],404);
        }
        return response()->json(['sucesso' => 'Marca deletada'],200); 
    }
}
