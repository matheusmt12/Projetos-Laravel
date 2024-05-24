<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_inicio_periodo',
        'data_previsto_periodo',
        'data_final_previsto_periodo',
        'valor',
        'km_inicial',
        'km_final',
        'id_cliente',
        'id_carro'
    ];


    public function rules(){
        return [
            'data_inicio_periodo' => 'required',
            'data_previsto_periodo'=> 'required',
            'data_final_previsto_periodo'=> 'required',
            'valor' => 'required',
            'km_inicial' => 'required',
            'km_final' => 'required',
            'id_cliente' => 'required',
            'id_carro' => 'required'
        ];
    }

    public function feedback(){
        return ['required' => 'O campo :attribute é requerido'];
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class,'id_cliente');
    }

    public function carro(){
        return $this->belongsTo(Carro::class,'id_carro');
    }
}
