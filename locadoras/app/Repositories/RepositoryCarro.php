<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class RepositoryCarro extends AbstractRepository{


    protected $modelo;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function delete($id)
    {
        $this->model = $this->model->find($id);
        if($this->model == null){
            return null;
        }
        else if($this->model->locacoes()->count() > 0){
            return -1;
        }

        return $this->model->delete();

        
    }
}