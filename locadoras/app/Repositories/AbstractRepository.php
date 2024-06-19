<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class AbstractRepository{

    
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function getAll(){
        return $this->model->get();
    }
    
    public function getAllPaginate($numPage){
        
        return $this->model->paginate($numPage);
    }

    public function create($request){
        return $this->model->create($request->all());
    }

    public function get($id){
        return $this->model->find($id);
    }

    public function edit($id, $request){

        $this->model = $this->model->find($id);
        if($this->model == null){
            return null;
        }
        $this->model->update($request->all());
        return $this->model;
    }

    public function filtro($request){
        $filtros = explode(';',$request);
            
        foreach( $filtros as $key => $condicao){
            $c= explode(':',$condicao);
            
             $this->model = $this->model->where($c[0],$c[1],$c[2]);
        }
    }
    public function selectModelosMarca($modelo){
         $this->model = $this->model->with($modelo);
    }

    public function getResult(){
        return $this->model->get();
    }

    public function getResultPaginate($numPag){
        return $this->model->paginate($numPag);
    }
}