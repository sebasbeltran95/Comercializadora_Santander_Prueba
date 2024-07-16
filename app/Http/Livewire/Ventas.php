<?php

namespace App\Http\Livewire;

use App\Models\Clientes;
use App\Models\Descuentos;
use App\Models\Productos;
use App\Models\Ventas as ModelsVentas;
use Livewire\Component;
use Livewire\WithPagination;


class Ventas extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $id_producto, $id_cliente, $n_stock, $id_des;
    public $idx, $id_productox, $id_clientex, $n_stockx, $id_desx;
    public $produc, $product, $client, $clientt, $descuent,$descuentt;

    protected $listeners = ['render', 'delete'];

    public function getVentasProperty()
    {
        if($this->search == ""){
            return ModelsVentas::orderBy('id','DESC')->paginate(5);
        } else {
            return ModelsVentas::
            orWhere('n_stock', 'LIKE', '%'.$this->search.'%')
            ->paginate(3);
        } 
    }

    public function crear()
    {
        $this->validate([
            'id_producto' => 'required|numeric',
            'id_cliente' => 'required|numeric',
            'n_stock' => 'required|numeric',
            'id_des' => 'required|numeric',

        ],[
            'id_producto.required' => 'El campo Producto es obligatorio',
            'id_producto.string' => 'El campo Producto  recibe solonumeros enteros',
            'id_cliente.required' => 'El campo Cliente es obligatorio',
            'id_cliente.string' => 'El campo Cliente recibe solo numeros enteros',
            'n_stock.required' => 'El campo Stock es obligatorio',
            'n_stock.string' => 'El campo Stock recibe solo numeros enteros',
            'id_des.required' => 'El campo Descuento es obligatorio',
            'id_des.string' => 'El campo Descuento recibe solo numeros enteros',
        ]);
       
        $tipo = new ModelsVentas();
        $tipo->id_producto = $this->id_producto;
        $tipo->id_cliente = $this->id_cliente;
        $tipo->n_stock = $this->n_stock;
        $tipo->id_des = $this->id_des;
        $tipo->save();
        $this->reset();
        $msj = ['!Registrado!', 'Se registro la Venta', 'success'];
        $this->emit('ok', $msj);
    }

    public function datacliente($obj)
    {
        $this->idx = $obj['id'];
        $this->id_productox = $obj['id_producto'];
        $this->id_clientex = $obj['id_cliente'];
        $this->n_stockx = $obj['n_stock'];
        $this->id_desx = $obj['id_des'];
    }

    public function actualizar()
    {
        $data = ModelsVentas::find($this->idx);
        $data->id_producto = $this->id_productox;
        $data->id_cliente = $this->id_clientex;
        $data->n_stock = $this->n_stockx;
        $data->id_des = $this->id_desx;
        $data->save();
        $msj = ['!Actualizado!', 'Se actualizo la Venta', 'success'];
        $this->emit('ok', $msj);
    }

    public function delete($post)
    {
        ModelsVentas::where('id',$post)->first()->delete();
    }

    public function render()
    {
        $this->produc =  Productos::all();
        $this->product = Productos::class;
        $this->client = Clientes::all();
        $this->clientt = Clientes::class;
        $this->descuent = Descuentos::all();
        $this->descuentt = Descuentos::class;
        return view('livewire.ventas')->extends('layouts.plantilla_back')->section('contenido');
    }
}
