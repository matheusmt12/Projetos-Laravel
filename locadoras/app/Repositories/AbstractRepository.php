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
        return $this->model->with('modelos')->get();
    }

    public function create($request){
        return $this->model->create($request->all());
    }

    public function get($id){
        return $this->model->with('modelos')->find($id);
    }

    public function edit($id, $request){

        $this->model = $this->model->find($id);
        if($this->model == null){
            return null;
        }
        $this->model->update($request->all());
        return $this->model;
    }

    public function delete($id){

        $this->model = $this->model->find($id);

        if( $this->model == null){
            return null;
        }

        return $this->model->delete();

    }
}