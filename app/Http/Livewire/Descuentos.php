<?php

namespace App\Http\Livewire;

use App\Models\Descuentos as ModelsDescuentos;
use App\Models\Productos;
use Livewire\Component;
use Livewire\WithPagination;


class Descuentos extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $producto_id, $descuento;
    public $idx, $producto_idx, $descuentox;
    public $produc, $product;

    protected $listeners = ['render', 'delete'];

    public function getDescuentosProperty()
    {
        if($this->search == ""){
            return ModelsDescuentos::orderBy('id','DESC')->paginate(5);
        } else {
            return ModelsDescuentos::
            orWhere('descuento', 'LIKE', '%'.$this->search.'%')
            ->paginate(3);
        } 
    }

    public function crear()
    {
        $this->validate([
            'producto_id' => 'required|numeric',
            'descuento' => 'required|numeric',
        ],[
            'producto_id.required' => 'El campo Producto Producto es obligatorio',
            'producto_id.string' => 'El campo Producto Producto recibe solo numeros enteros',
            'descuento.required' => 'El campo Descuento es obligatorio',
            'descuento.string' => 'El campo Descuento recibe solo numeros enteros',
        ]);
       
        $tipo = new ModelsDescuentos();
        $tipo->producto_id = $this->producto_id;
        $tipo->descuento = $this->descuento;
        $tipo->save();
        $this->reset();
        $msj = ['!Registrado!', 'Se registro el Descuento', 'success'];
        $this->emit('ok', $msj);
    }

    public function datacliente($obj)
    {
        $this->idx = $obj['id'];
        $this->producto_idx = $obj['producto_id'];
        $this->descuentox = $obj['descuento'];
    }

    public function actualizar()
    {
        $data = ModelsDescuentos::find($this->idx);
        $data->producto_id = $this->producto_idx;
        $data->descuento = $this->descuentox;
        $data->save();
        $msj = ['!Actualizado!', 'Se actualizo el Descuento', 'success'];
        $this->emit('ok', $msj);
    }

    public function delete($post)
    {
        ModelsDescuentos::where('id',$post)->first()->delete();
    }


    public function render()
    {
        $this->produc =  Productos::all();
        $this->product = Productos::class;
        return view('livewire.descuentos')->extends('layouts.plantilla_back')->section('contenido');
    }
}
