<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\ComparisonMethodDoesNotDeclareBoolReturnTypeException;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'imagem'];

    public function rules()
    {
        return ['name' => 'required|unique:marcas'];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'name.unique' => 'O campo :attribute é unico'
        ];
    }
}
