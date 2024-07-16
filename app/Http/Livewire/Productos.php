<?php

namespace App\Http\Livewire;

use App\Models\Productos as ModelsProductos;
use Livewire\Component;
use Livewire\WithPagination;


class Productos extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $nombre, $precio, $stock;
    public $idx, $nombrex, $preciox, $stockx;

    protected $listeners = ['render', 'delete'];

    public function getProductosProperty()
    {
        if($this->search == ""){
            return ModelsProductos::orderBy('id','DESC')->paginate(5);
        } else {
            return ModelsProductos::
            orWhere('nombre', 'LIKE', '%'.$this->search.'%')
            ->orWhere('precio', 'LIKE', '%'.$this->search.'%')
            ->orWhere('stock', 'LIKE', '%'.$this->search.'%')
            ->orWhere('codigo_producto', 'LIKE', '%'.$this->search.'%')
            ->paginate(3);
        } 
    }

    public function crear()
    {
        $this->validate([
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric',
            'stock' => 'required|numeric',

        ],[
            'nombre.required' => 'El campo Nombre Producto es obligatorio',
            'nombre.string' => 'El campo Nombre Producto recibe solo cadena de texto',
            'nombre.max' => 'El campo Nombre Producto debe contener maximo 100 caracteres',
            'precio.required' => 'El campo precio es obligatorio',
            'precio.string' => 'El campo precio recibe solo numeros enteros',
            'stock.required' => 'El campo Stock es obligatorio',
            'stock.string' => 'El campo Stock recibe solo numeros enteros',
        ]);
        
        $tipo = new ModelsProductos();
        $tipo->codigo_producto = rand();
        $tipo->nombre = $this->nombre;
        $tipo->precio = $this->precio;
        $tipo->stock = $this->stock;
        $tipo->save();
        $this->reset();
        $msj = ['!Registrado!', 'Se registro el Producto', 'success'];
        $this->emit('ok', $msj);
    }

    public function datacliente($obj)
    {
        $this->idx = $obj['id'];
        $this->nombrex = $obj['nombre'];
        $this->preciox = $obj['precio'];
        $this->stockx = $obj['stock'];
    }

    public function actualizar()
    {
        $data = ModelsProductos::find($this->idx);
        $data->nombre = $this->nombrex;
        $data->precio = $this->preciox;
        $data->stock = $this->stockx;
        $data->save();
        $msj = ['!Actualizado!', 'Se actualizo el Producto', 'success'];
        $this->emit('ok', $msj);
    }

    public function delete($post)
    {
        ModelsProductos::where('id',$post)->first()->delete();
    }

    public function render()
    {
        return view('livewire.productos')->extends('layouts.plantilla_back')->section('contenido');
    }
}
