<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $table = 'productos';

    public function getKeyName(){
        return "id";
    }

    public $fillable = [
        'id',
        'codigo_producto',
        'nombre',
        'precio',
        'stock',
        'created_at',
        'updated_at'
    ];
}
