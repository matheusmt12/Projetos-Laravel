<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    public function rules(){
        return ['nome' => 'required'];
    }

    public function feedback(){
        return ['required' => 'o campo :attribute é requerido'];
    }

    public function locacoes(){

        return $this->hasMany(Locacao::class,'id_cliente');
    }
}
