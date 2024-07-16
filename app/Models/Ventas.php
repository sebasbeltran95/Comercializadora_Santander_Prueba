<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;
    protected $table = 'ventas';

    public function getKeyName(){
        return "id";
    }

    public $fillable = [
        'id',
        'id_producto',
        'id_cliente',
        'n_stock',
        'id_des',
        'created_at',
        'updated_at'
    ];
}
