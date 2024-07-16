<div>
    @section('title', 'Clientes')
    <div class="container-fluid">
       <div class="row text-center mb-3">
           <div class="col-md-12 d-flex justify-content-between align-items-center">
               <h1 class="display-1">Clientes</h1>
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
                               <th class="text-center">Telefono</th>
                               <th class="text-center">Correo</th>
                               <th class="text-center">Fecha Ingreso</th>
                               <th class="text-center">Acciones</th>
                           </tr>
                       </thead>
                       <tbody>
                           @forelse ($this->clientes as $p)
                               <tr>
                                   <td class="text-center">{{ $p->nombre_completo }}</td>
                                   <td class="text-center">{{ $p->telefono }}</td>
                                   <td class="text-center">{{ $p->correo }}</td>
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
                   {{ $this->clientes->links() }}
               </div>
           </div>
       </div>
 
       {{-- Modal crear Cliente --}}
       <div class="modal fade" id="modalCrearTipoDoc" tabindex="-1" wire:ignore.self>
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <h4 class="modal-title">Crear Cliente</h4>
                   </div>
                   <div class="modal-body">
                         <div class="form-group mb-2">
                             <label class="@error('nombre_completo') text-danger @enderror">Combre Completo</label>
                             <input type="text" class="form-control @error('nombre_completo') text-danger @enderror" wire:model="nombre_completo">
                             <i class="text-danger">
                                 @error('nombre_completo') {{ $message }} @enderror
                             </i>
                         </div>
                         <div class="form-group mb-2">
                             <label class="@error('telefono') text-danger @enderror">Telefono</label>
                             <input type="text" class="form-control @error('telefono') text-danger @enderror" wire:model="telefono">
                             <i class="text-danger">
                                 @error('telefono') {{ $message }} @enderror
                             </i>
                         </div>
                         <div class="form-group mb-2">
                             <label class="@error('correo') text-danger @enderror">Correo</label>
                             <input type="text" class="form-control @error('correo') text-danger @enderror" wire:model="correo">
                             <i class="text-danger">
                                 @error('correo') {{ $message }} @enderror
                             </i>
                         </div>
                   </div>
                   <div class="modal-footer">
                       <button type="submit" class="btn btn-primary" wire:click='crear'>Registrar Cliente</button>
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
                                   <h4 class="modal-title">Editar Cliente</h4>
                               </div>
                               <div class="modal-body">
                                     <div class="form-group mb-2">
                                         <label>Nombre Completo</label>
                                         <input type="text" class="form-control" wire:model="nombre_completox">
                                     </div>
                                     <div class="form-group mb-2">
                                         <label>Telefono</label>
                                         <input type="text" class="form-control" wire:model="telefonox">
                                     </div>
                                     <div class="form-group mb-2">
                                         <label>Correo</label>
                                         <input type="text" class="form-control" wire:model="correox">
                                     </div>
                               </div>
                               <div class="modal-footer">
                                   <button type="submit" class="btn btn-primary" wire:click="actualizar">Editar
                                    Cliente</button>
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
                livewire.emitTo('clientes', 'delete', postId);

                Swal.fire({
                title: "!Eliminado!",
                text: "Se elimino el Cliente",
                icon: "success"
                });
            }
        });
    });
</script>
@endpush