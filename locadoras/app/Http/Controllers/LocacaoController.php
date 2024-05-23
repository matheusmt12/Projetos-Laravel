<?php

namespace App\Http\Controllers;

use App\Models\Locacao;
use Illuminate\Http\Request;

class LocacaoController extends Controller
{

    protected $locacao;

    public function __construct(Locacao $locacao){
        $this->locacao = $locacao;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $locacoes = $this->locacao->all();
     
     if( $locacoes->count() <= 0){
        return response()->json(['erro'=> 'não ha nenhuma locacao no momento'],404);
     }

     return response()->json($locacoes,200);
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

        $locacao = $this->locacao->create($request->all());

        return response()->json($locacao,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Locacao  $locacao
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $locacao = $this->locacao->find($id);

        if($locacao == null){
            return response()->json(['erro' => 'não foi possivel encontrar a locacao']);
        }
        return response()->json($locacao,200);
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

        dd($request->all());
        $locacao = $this->locacao->find($id);

        if($locacao == null){
            return response()->json(['erro' => 'não foi possive encontrar a locacao']);
        }

        $locacao->update($request->all());
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
        $locacao = $this->locacao->find($id);

        if($locacao == null){
            return response()->json(['erro' => 'não foi possive encontrar a locacao']);
        }

        $locacao->delete();

        return response()->json(['sucesso' => 'locacao deletada']);
    }
}
