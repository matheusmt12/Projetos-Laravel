<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class RepositoryMarca extends AbstractRepository
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
        }

        return $this->model->delete();
    }
}
