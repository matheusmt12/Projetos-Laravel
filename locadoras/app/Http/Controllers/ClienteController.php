<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Repositories\RepositoryCliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $cliente;
    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }
    public function index()
    {
        $repository = new RepositoryCliente($this->cliente);
        $clientes = $repository->getAll();

        if($clientes->count() <= 0){
            return response()->json(['info' => 'não há nenhum elemento na lista']);
        }

        return response()->json($clientes,200);
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
     * @param  \App\Http\Requests\StoreClienteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $repository = new RepositoryCliente($this->cliente);

        $request->validate($this->cliente->rules(),$this->cliente->feedback());

        $cliente =$repository->create($request);

        return response()->json($cliente,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $repository = new RepositoryCliente($this->cliente);

        $cliente = $repository->get($id);

        if($cliente == null){
            return response()->json(['erro' => 'não ha nenhum cliente com este id'],404);
        }

        return response()->json($cliente, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClienteRequest  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $repository = new RepositoryCliente($this->cliente);

        $cliente = $repository->edit($id,$request);

        if($cliente == null){
            return response()->json(['erro' => 'não ha nenhum cliente com este id'],404);
        }
        return response()->json($cliente,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $repository = new RepositoryCliente($this->cliente);
        

        $cliente = $repository->delete($id);
       // dd($cliente);
        if($cliente == null){
            return response()->json(['erro' => 'não ha nenhum cliente com este id'],404);
        }else if($cliente === -1){
            return response()->json(['info'=> 'esta com um veiculo pendente']);
        }

        return response()->json(['sucesso' => 'cliente desativado'],200);
    }
}
