<div>
    @section('title', 'Productos')
    <div class="container-fluid">
       <div class="row text-center mb-3">
           <div class="col-md-12 d-flex justify-content-between align-items-center">
               <h1 class="display-1">Productos</h1>
               <button class="btn btn-primary rounded-circle " data-bs-toggle="modal"
                   data-bs-target="#modalCrearTipoDoc">+</button>
           </div>
       </div>
       <div class="row">
           <div class="col-12">
               <div class="table-responsive">
                   <table class="table  table-hover table-bordered">
                       <thead>
                           <th colspan="5">
                               <div class="input-group input-group-sm">
                                   <input type="text" class="form-control"
                                   placeholder="Ingrese el campo que desea buscar"
                                   wire:model="search">
                               </div>
                           </th>
                           <tr>
                               <th class="text-center">Nombre</th>
                               <th class="text-center">Precio</th>
                               <th class="text-center">Stock</th>
                               <th class="text-center">Fecha Ingreso</th>
                               <th class="text-center">Acciones</th>
                           </tr>
                       </thead>
                       <tbody>
                           @forelse ($this->productos as $p)
                               <tr>
                                   <td class="text-center">{{ $p->nombre }}</td>
                                   <td class="text-center">${{ number_format($p->precio) }}</td>
                                   <td class="text-center">{{ $p->stock }}</td>
                                   <td class="text-center">{{ $p->created_at }}</td>
                                   <td class="d-flex justify-content-center">
                                       <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                           <button type="button" class="btn btn-sm btn-warning"
                                               wire:click="datacliente({{ $p }})" data-bs-toggle="modal"
                                               data-bs-target="#Modaleditar"><i class="fas fa-user-edit"></i></button>
                                           <button type="submit" class="btn btn-sm btn-danger"
                                               wire:click="$emit('deletePost',{{$p->id}})"><i
                                                   class="fas fa-trash-alt"></i></button>
                                       </div>
                                   </td>
                               </tr>
                           @empty
                               <tr>
                                   <td colspan="5" class="text-center">No hay registros</td>
                               </tr>
                           @endforelse
                       </tbody>
                   </table>
                   {{ $this->productos->links() }}
               </div>
           </div>
       </div>
 
       {{-- Modal crear Cliente --}}
       <div class="modal fade" id="modalCrearTipoDoc" tabindex="-1" wire:ignore.self>
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <h4 class="modal-title">Crear Producto</h4>
                   </div>
                   <div class="modal-body">
                         <div class="form-group mb-2">
                             <label class="@error('nombre') text-danger @enderror">Nombre Producto</label>
                             <input type="text" class="form-control @error('nombre') text-danger @enderror" wire:model="nombre">
                             <i class="text-danger">
                                 @error('nombre') {{ $message }} @enderror
                             </i>
                         </div>
                         <div class="form-group mb-2">
                             <label class="@error('precio') text-danger @enderror">Precio</label>
                             <input type="number" class="form-control @error('precio') text-danger @enderror" wire:model="precio">
                             <i class="text-danger">
                                 @error('precio') {{ $message }} @enderror
                             </i>
                         </div>
                         <div class="form-group mb-2">
                             <label class="@error('stock') text-danger @enderror">Stock</label>
                             <input type="number" class="form-control @error('stock') text-danger @enderror" wire:model="stock">
                             <i class="text-danger">
                                 @error('stock') {{ $message }} @enderror
                             </i>
                         </div>
                   </div>
                   <div class="modal-footer">
                       <button type="submit" class="btn btn-primary" wire:click='crear'>Registrar Producto</button>
                       <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                   </div>
               </div>
           </div>
       </div>
       {{-- Fin modal crear Cliente --}}
 
 
       {{--  editar   --}}
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-12">
                   <div class="modal fade" id="Modaleditar" tabindex="-1" wire:ignore.self>
                       <div class="modal-dialog">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <h4 class="modal-title">Editar Producto</h4>
                               </div>
                               <div class="modal-body">
                                     <div class="form-group mb-2">
                                         <label>Nombre Producto</label>
                                         <input type="text" class="form-control" wire:model="nombrex">
                                     </div>
                                     <div class="form-group mb-2">
                                         <label>Precio</label>
                                         <input type="number" class="form-control" wire:model="preciox">
                                     </div>
                                     <div class="form-group mb-2">
                                         <label>Stock</label>
                                         <input type="number" class="form-control" wire:model="stockx">
                                     </div>
                               </div>
                               <div class="modal-footer">
                                   <button type="submit" class="btn btn-primary" wire:click="actualizar">Editar
                                       Producto</button>
                                   <button type="button" class="btn btn-danger"
                                       data-bs-dismiss="modal">Cerrar</button>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       {{--  editar   --}}
</div>
@push('js')
<script>
    Livewire.on('ok', msj =>{
        Swal.fire(
            msj[0],
            msj[1],
            msj[2],
        )
    });
    livewire.on('deletePost', postId => {
        Swal.fire({
            title: "¿Estas Seguro?",
            text: "¿Desea Eliminar este registro?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "SI"
        }).then((result) => {
            if (result.isConfirmed) {
                livewire.emitTo('productos', 'delete', postId);

                Swal.fire({
                title: "!Eliminado!",
                text: "Se elimino el Productos",
                icon: "success"
                });
            }
        });
    });
</script>
@endpush