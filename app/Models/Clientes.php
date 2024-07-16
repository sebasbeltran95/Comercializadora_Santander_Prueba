<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;
    protected $table = 'clientes';

    public function getKeyName(){
        return "id";
    }

    public $fillable = [
        'id',
        'nombre_completo',
        'telefono',
        'correo',
        'created_at',
        'updated_at'
    ];
}
