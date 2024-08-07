<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class RepositoryModelo extends AbstractRepository
{


    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function delete($id)
    {
        $this->model = $this->model->find($id);
        if ($this->model == null) {
            return null;
        }else if($this->model->carros()->count() > 0){
            return -1;
        }
        
        return $this->model->delete();

    }

    public function getAllPAginateModelo($numPage, $marca){

        return $this->model->with($marca)->paginate($numPage);
    }
}
