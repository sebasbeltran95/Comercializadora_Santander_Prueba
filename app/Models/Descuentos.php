<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Descuentos extends Model
{
    use HasFactory;
    protected $table = 'descuentos';

    public function getKeyName(){
        return "id";
    }

    public $fillable = [
        'id',
        'producto_id',
        'descuento',
        'created_at',
        'updated_at'
    ];
}
