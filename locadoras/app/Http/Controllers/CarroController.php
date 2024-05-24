<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Repositories\RepositoryCarro;
use Illuminate\Http\Request;

class CarroController extends Controller
{


    protected $carro;
    public function __construct(Carro $carro)
    {
        $this->carro = $carro;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repository = new RepositoryCarro($this->carro);

        $carros = $repository->getAll();

        if ($carros->count() <= 0) {
            return response()->json(['erro' => 'não há nenhum Carro'], 404);
        }

        return response()->json($carros, 200);
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
     * @param  \App\Http\Requests\StoreCarroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $repository = new RepositoryCarro($this->carro);

        $request->validate($this->carro->rules(), $this->carro->feedback());
        $carro = $repository->create($request);


        return response()->json($carro, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $repository = new RepositoryCarro($this->carro);

        $carro = $repository->get($id);

        if ($carro == null) {
            return response()->json(['erro' => 'Não foi possivel encontrar o Carro'], 404);
        }

        return response()->json($carro, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function edit(Carro $carro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarroRequest  $request
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $repository = new RepositoryCarro($this->carro);

        $carro = $repository->edit($id,$request);

        if ($carro == null) {
            return response()->json(['erro' => 'O Carro não foi encontrado']);
        }

        $carro->update($request->all());
        return response()->json($carro, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $repository = new RepositoryCarro($this->carro);

        $carro = $repository->delete($id);

        if ($carro == null) {
            return response()->json(['erro' => 'O Carro não foi encontrado'], 200);
        }else if($carro == -1){
            return response()->json(['info' => 'o carros esta alugado']);
        }

        return response()->json(['sucesso' => 'carro deletado'],200);
    }
}
