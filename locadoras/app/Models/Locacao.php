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
}
