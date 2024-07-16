<?php

namespace App\Http\Livewire;

use App\Models\Clientes as ModelsClientes;
use Livewire\Component;
use Livewire\WithPagination;


class Clientes extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $nombre_completo, $telefono, $correo;
    public $idx,$nombre_completox, $telefonox, $correox;


    protected $listeners = ['render', 'delete'];

    public function getClientesProperty()
    {
        if($this->search == ""){
            return ModelsClientes::orderBy('id','DESC')->paginate(5);
        } else {
            return ModelsClientes::
            orWhere('nombre_completo', 'LIKE', '%'.$this->search.'%')
            ->orWhere('telefono', 'LIKE', '%'.$this->search.'%')
            ->orWhere('correo', 'LIKE', '%'.$this->search.'%')
            ->paginate(3);
        } 
    }

    public function crear()
    {
        $this->validate([
            'nombre_completo' => 'required|string|max:100',
            'telefono' => 'required|string|max:100',
            'correo' => 'required|string|max:100',

        ],[
            'nombre_completo.required' => 'El campo Nombre Completo es obligatorio',
            'nombre_completo.string' => 'El campo Nombre Completo  recibe solo cadena de texto',
            'nombre_completo.max' => 'El campo Nombre Completo  debe contener maximo 100 caracteres',
            'telefono.required' => 'El campo Telefono es obligatorio',
            'telefono.string' => 'El campo Telefono recibe solo numeros enteros',
            'telefono.max' => 'El campo Telefono  debe contener maximo 100 caracteres',
            'correo.required' => 'El campo Correo es obligatorio',
            'correo.string' => 'El campo Correo recibe solo numeros enteros',
            'correo.max' => 'El campo Correo  debe contener maximo 100 caracteres',

        ]);
       
        $tipo = new ModelsClientes();
        $tipo->nombre_completo = $this->nombre_completo;
        $tipo->telefono = $this->telefono;
        $tipo->correo = $this->correo;
        $tipo->save();
        $this->reset();
        $msj = ['!Registrado!', 'Se registro el Cliente', 'success'];
        $this->emit('ok', $msj);
    }

    public function datacliente($obj)
    {
        $this->idx = $obj['id'];
        $this->nombre_completox = $obj['nombre_completo'];
        $this->telefonox = $obj['telefono'];
        $this->correox = $obj['correo'];
    }

    public function actualizar()
    {
        $data = ModelsClientes::find($this->idx);
        $data->nombre_completo = $this->nombre_completox;
        $data->telefono = $this->telefonox;
        $data->correo = $this->correox;
        $data->save();
        $msj = ['!Actualizado!', 'Se actualizo el Cliente', 'success'];
        $this->emit('ok', $msj);
    }

    public function delete($post)
    {
        ModelsClientes::where('id',$post)->first()->delete();
    }

    public function render()
    {
        return view('livewire.clientes')->extends('layouts.plantilla_back')->section('contenido');
    }
}
