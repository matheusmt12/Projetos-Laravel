<?php

namespace App\Http\Controllers;

use App\Models\Locacao;
use App\Repositories\RepositoryLocacao;
use Illuminate\Http\Request;

class LocacaoController extends Controller
{

    protected $locacao;

    public function __construct(Locacao $locacao)
    {
        $this->locacao = $locacao;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $repository = new RepositoryLocacao($this->locacao);
        $locacoes = $repository->getAll();
        if ($locacoes->count() <= 0) {
            return response()->json(['erro' => 'não ha nenhuma locacao no momento'], 404);
        }

        return response()->json($locacoes, 200);
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
     * @param  \App\Http\Requests\StoreLocacaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $repository = new RepositoryLocacao($this->locacao);

        $request->validate($this->locacao->rules(),$this->locacao->feedback());

        $locacao = $repository->create($request);

        return response()->json($locacao, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Locacao  $locacao
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $repository = new RepositoryLocacao($this->locacao);

        $locacao = $repository->get($id);

        if ($locacao == null) {
            return response()->json(['erro' => 'não foi possivel encontrar a locacao']);
        }
        return response()->json($locacao, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Locacao  $locacao
     * @return \Illuminate\Http\Response
     */
    public function edit(Locacao $locacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLocacaoRequest  $request
     * @param  \App\Models\Locacao  $locacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $repository = new RepositoryLocacao($this->locacao);
        
        $locacao = $repository->edit($id,$request);

        if ($locacao == null) {
            return response()->json(['erro' => 'não foi possive encontrar a locacao']);
        }

        return response()->json($locacao, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Locacao  $locacao
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $repository = new RepositoryLocacao($this->locacao);

        $locacao = $repository->delete($id);

        if ($locacao == null) {
            return response()->json(['erro' => 'não foi possive encontrar a locacao']);
        }


        return response()->json(['sucesso' => 'locacao deletada']);
    }
}
