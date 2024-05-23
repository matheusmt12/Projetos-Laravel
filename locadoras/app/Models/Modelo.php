<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'imagem', 'numero_portas', 'lugares', 'air_bag', 'abs', 'id_marca'];


    public function rules()
    {
        return [
            'nome' => 'required|unique:modelos',
            'imagem' => 'required',
            'numero_portas' => 'required',
            'lugares' => 'required',
            'air_bag' => 'required',
            'abs' => 'required',
            'id_marca' => 'required'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'o campo :attribute é obrigatório',
            'nome.unique' => 'o campo :attribute é unico'
        ];
    }
}
