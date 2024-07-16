<?php

use App\Http\Livewire\Clientes;
use App\Http\Livewire\Descuentos;
use App\Http\Livewire\Productos;
use App\Http\Livewire\Ventas;
use Illuminate\Support\Facades\Route;



// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', Productos::class)->name('/');
Route::get('/clientes', Clientes::class)->name('clientes');
Route::get('/descuentos', Descuentos::class)->name('descuentos');
Route::get('/ventas', Ventas::class)->name('ventas');

