<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;

    protected $fillable = ['placa', 'disponivel', 'km', 'id_modelo'];

    public function rules()
    {
        return [
            'placa' => 'required',
            'disponivel' => 'required', 
            'km' => 'required',
            'id_modelo' => 'required'
        ];
    }
    public function feedback(){
        return ['required' => 'o campo :attribute é requerido'];
    }
}
